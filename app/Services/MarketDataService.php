<?php

namespace App\Services;

use Illuminate\Support\Facades\Check;
use Illuminate\Support\Facades\Http;

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
        try {
            $response = Http::timeout(5)->get("{$this->baseUrl}/coins/markets", [
                'vs_currency' => 'usd',
                'order' => 'market_cap_desc',
                'per_page' => $limit,
                'page' => 1,
                'sparkline' => 'false',
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            return [];
        } catch (\Exception $e) {
            // Log error or handle gracefully
            return [];
        }
    }
}
