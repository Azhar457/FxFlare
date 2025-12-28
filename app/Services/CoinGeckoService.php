<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CoinGeckoService
{
    private string $baseUrl;
    private int $cacheTtl;

    public function __construct()
    {
        $this->baseUrl = config('services.coingecko.url', 'https://api.coingecko.com/api/v3');
        $this->cacheTtl = config('services.coingecko.cache_ttl', 300); // 5 minutes default
    }

    /**
     * Fetch current prices for multiple coins
     * 
     * @param array $coinIds Array of CoinGecko coin IDs (e.g., ['bitcoin', 'ethereum'])
     * @return array|null
     */
    public function fetchCoinPrices(array $coinIds): ?array
    {
        $cacheKey = 'coingecko_prices_' . md5(implode(',', $coinIds));

        return Cache::remember($cacheKey, $this->cacheTtl, function () use ($coinIds) {
            try {
                $response = Http::timeout(10)->get("{$this->baseUrl}/simple/price", [
                    'ids' => implode(',', $coinIds),
                    'vs_currencies' => 'usd',
                    'include_24hr_change' => 'true',
                ]);

                if ($response->successful()) {
                    return $response->json();
                }

                Log::error('CoinGecko API error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return null;
            } catch (\Exception $e) {
                Log::error('CoinGecko API exception', [
                    'message' => $e->getMessage()
                ]);
                return null;
            }
        });
    }

    /**
     * Fetch detailed market data for coins
     * 
     * @param int $perPage Number of coins to fetch
     * @param string $order Sort order
     * @return array|null
     */
    public function fetchMarketData(int $perPage = 10, string $order = 'market_cap_desc'): ?array
    {
        $cacheKey = "coingecko_markets_{$perPage}_{$order}";

        return Cache::remember($cacheKey, $this->cacheTtl, function () use ($perPage, $order) {
            try {
                $response = Http::timeout(10)->get("{$this->baseUrl}/coins/markets", [
                    'vs_currency' => 'usd',
                    'order' => $order,
                    'per_page' => $perPage,
                    'page' => 1,
                    'sparkline' => false,
                    'price_change_percentage' => '24h',
                ]);

                if ($response->successful()) {
                    return $response->json();
                }

                Log::error('CoinGecko market data error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return null;
            } catch (\Exception $e) {
                Log::error('CoinGecko market data exception', [
                    'message' => $e->getMessage()
                ]);
                return null;
            }
        });
    }

    /**
     * Get our supported coin mappings (symbol to CoinGecko ID)
     * 
     * @return array
     */
    public function getSupportedCoins(): array
    {
        return [
            'BTC' => 'bitcoin',
            'ETH' => 'ethereum',
            'USDT' => 'tether',
            'BNB' => 'binancecoin',
            'XRP' => 'ripple',
            'ADA' => 'cardano',
            'SOL' => 'solana',
            'DOGE' => 'dogecoin',
            'DOT' => 'polkadot',
            'MATIC' => 'matic-network',
        ];
    }

    /**
     * Update asset prices in database
     * 
     * @return int Number of assets updated
     */
    public function updateAssetPrices(): int
    {
        $supportedCoins = $this->getSupportedCoins();
        $coinIds = array_values($supportedCoins);

        $prices = $this->fetchCoinPrices($coinIds);

        if (!$prices) {
            return 0;
        }

        $updated = 0;
        foreach ($supportedCoins as $symbol => $coinId) {
            if (isset($prices[$coinId])) {
                $asset = \App\Models\Asset::where('symbol', $symbol)->first();

                if ($asset) {
                    $asset->update([
                        'price' => $prices[$coinId]['usd'] ?? $asset->price,
                        'change_24h' => $prices[$coinId]['usd_24h_change'] ?? $asset->change_24h,
                    ]);
                    $updated++;
                }
            }
        }

        Log::info("Updated {$updated} asset prices from CoinGecko");

        return $updated;
    }
}
