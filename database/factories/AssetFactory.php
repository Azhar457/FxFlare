<?php

namespace Database\Factories;

use App\Models\Asset;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asset>
 */
class AssetFactory extends Factory
{
    protected $model = Asset::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cryptos = [
            ['symbol' => 'BTC', 'name' => 'Bitcoin'],
            ['symbol' => 'ETH', 'name' => 'Ethereum'],
            ['symbol' => 'USDT', 'name' => 'Tether'],
            ['symbol' => 'BNB', 'name' => 'Binance Coin'],
            ['symbol' => 'XRP', 'name' => 'Ripple'],
            ['symbol' => 'ADA', 'name' => 'Cardano'],
            ['symbol' => 'SOL', 'name' => 'Solana'],
            ['symbol' => 'DOGE', 'name' => 'Dogecoin'],
            ['symbol' => 'DOT', 'name' => 'Polkadot'],
            ['symbol' => 'MATIC', 'name' => 'Polygon'],
        ];

        $crypto = $this->faker->randomElement($cryptos);

        return [
            'symbol' => $crypto['symbol'],
            'name' => $crypto['name'],
            'price' => $this->faker->randomFloat(2, 0.01, 50000),
            'change_24h' => $this->faker->randomFloat(2, -20, 20),
        ];
    }
}
