<?php

namespace App\Console\Commands;

use App\Services\CoinGeckoService;
use Illuminate\Console\Command;

class UpdateAssetPricesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assets:update-prices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update asset prices from CoinGecko API';

    /**
     * Execute the console command.
     */
    public function handle(CoinGeckoService $coinGecko): int
    {
        $this->info('Updating asset prices from CoinGecko...');

        try {
            $updated = $coinGecko->updateAssetPrices();

            if ($updated > 0) {
                $this->info("✅ Successfully updated {$updated} asset prices.");
                return Command::SUCCESS;
            } else {
                $this->warn('⚠️  No assets were updated. API might be unavailable.');
                return Command::FAILURE;
            }
        } catch (\Exception $e) {
            $this->error('❌ Error updating prices: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
