<?php

namespace Database\Seeders;

use App\Models\Asset;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if assets already exist to prevent duplicates
        if (Asset::count() > 0) {
            $this->command->info('Assets already exist. Skipping seed.');
            return;
        }

        $assets = [
            ['symbol' => 'BTC', 'name' => 'Bitcoin', 'price' => 45000.00, 'change_24h' => 2.5],
            ['symbol' => 'ETH', 'name' => 'Ethereum', 'price' => 2500.00, 'change_24h' => 3.2],
            ['symbol' => 'USDT', 'name' => 'Tether', 'price' => 1.00, 'change_24h' => 0.01],
            ['symbol' => 'BNB', 'name' => 'Binance Coin', 'price' => 320.00, 'change_24h' => 1.8],
            ['symbol' => 'XRP', 'name' => 'Ripple', 'price' => 0.65, 'change_24h' => -1.2],
            ['symbol' => 'ADA', 'name' => 'Cardano', 'price' => 0.55, 'change_24h' => 4.5],
            ['symbol' => 'SOL', 'name' => 'Solana', 'price' => 110.00, 'change_24h' => 6.7],
            ['symbol' => 'DOGE', 'name' => 'Dogecoin', 'price' => 0.08, 'change_24h' => -2.3],
            ['symbol' => 'DOT', 'name' => 'Polkadot', 'price' => 7.50, 'change_24h' => 1.1],
            ['symbol' => 'MATIC', 'name' => 'Polygon', 'price' => 0.85, 'change_24h' => 3.8],
        ];

        foreach ($assets as $asset) {
            Asset::create($asset);
        }

        $this->command->info('✅ Successfully seeded 10 cryptocurrency assets.');
    }
}
