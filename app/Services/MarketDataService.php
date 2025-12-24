<?php

namespace App\Services;

use Illuminate\Support\Facades\Check;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class MarketDataService
{
    protected $baseUrl = 'https://api.coingecko.com/api/v3';

    /**
     * Fetch top cryptocurrencies by market cap.
     *
     * @param int $limit
     * @return array
     */
    public function getTopCoins(int $limit = 10)
    {
        return Cache::remember('market_data_top_' . $limit, 300, function () use ($limit) { // Cache for 5 minutes
            try {
                $response = Http::timeout(10)
                    ->withHeaders([
                        'Accept' => 'application/json',
                    ])
                    ->withoutVerifying() // Fix for local SSL issues
                    ->get("{$this->baseUrl}/coins/markets", [
                        'vs_currency' => 'usd',
                        'order' => 'market_cap_desc',
                        'per_page' => $limit,
                        'page' => 1,
                        'sparkline' => 'false',
                    ]);

                if ($response->successful()) {
                    return $response->json();
                }

                Log::error('CoinGecko API Error: ' . $response->body());
                return $this->getFallbackData();
            } catch (\Exception $e) {
                Log::error('Market Data Service Connection Error: ' . $e->getMessage());
                return $this->getFallbackData();
            }
        });
    }

    private function getFallbackData()
    {
        return [
            [
                'id' => 'bitcoin',
                'symbol' => 'btc',
                'name' => 'Bitcoin',
                'image' => 'https://assets.coingecko.com/coins/images/1/large/bitcoin.png',
                'current_price' => 95000,
                'market_cap' => 1800000000000,
                'total_volume' => 50000000000,
                'price_change_percentage_24h' => 2.5,
            ],
            [
                'id' => 'ethereum',
                'symbol' => 'eth',
                'name' => 'Ethereum',
                'image' => 'https://assets.coingecko.com/coins/images/279/large/ethereum.png',
                'current_price' => 3500,
                'market_cap' => 400000000000,
                'total_volume' => 20000000000,
                'price_change_percentage_24h' => 1.2,
            ],
            [
                'id' => 'solana',
                'symbol' => 'sol',
                'name' => 'Solana',
                'image' => 'https://assets.coingecko.com/coins/images/4128/large/solana.png',
                'current_price' => 145,
                'market_cap' => 65000000000,
                'total_volume' => 3000000000,
                'price_change_percentage_24h' => -0.5,
            ],
        ];
    }
}
