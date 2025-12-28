<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 0. Buat Assets (Cryptocurrency) untuk Watchlist
        Asset::factory()->create([
            'symbol' => 'BTC',
            'name' => 'Bitcoin',
            'price' => 45000.00,
            'change_24h' => 2.5,
        ]);

        Asset::factory()->create([
            'symbol' => 'ETH',
            'name' => 'Ethereum',
            'price' => 2500.00,
            'change_24h' => 3.2,
        ]);

        Asset::factory()->create([
            'symbol' => 'USDT',
            'name' => 'Tether',
            'price' => 1.00,
            'change_24h' => 0.01,
        ]);

        Asset::factory()->create([
            'symbol' => 'BNB',
            'name' => 'Binance Coin',
            'price' => 320.00,
            'change_24h' => 1.8,
        ]);

        Asset::factory()->create([
            'symbol' => 'XRP',
            'name' => 'Ripple',
            'price' => 0.65,
            'change_24h' => -1.2,
        ]);

        Asset::factory()->create([
            'symbol' => 'ADA',
            'name' => 'Cardano',
            'price' => 0.55,
            'change_24h' => 4.5,
        ]);

        Asset::factory()->create([
            'symbol' => 'SOL',
            'name' => 'Solana',
            'price' => 110.00,
            'change_24h' => 6.7,
        ]);

        Asset::factory()->create([
            'symbol' => 'DOGE',
            'name' => 'Dogecoin',
            'price' => 0.08,
            'change_24h' => -2.3,
        ]);

        Asset::factory()->create([
            'symbol' => 'DOT',
            'name' => 'Polkadot',
            'price' => 7.50,
            'change_24h' => 1.1,
        ]);

        Asset::factory()->create([
            'symbol' => 'MATIC',
            'name' => 'Polygon',
            'price' => 0.85,
            'change_24h' => 3.8,
        ]);

        // 1. Buat Role Spesifik
        $adminRole = Role::factory()->create(['name' => 'admin']);
        $userRole = Role::factory()->create(['name' => 'user']);

        // 2. Buat 1 User Admin (untuk kamu login nanti)
        User::factory()->create([
            'name' => 'adminfxflare',
            'email' => 'admin@fxflare.my.id',
            'password' => bcrypt('fxflare1'), // password default
            'role_id' => $adminRole->id,
        ]);

        // 3. Buat beberapa Kategori & Tag
        $categories = Category::factory(5)->create();
        $tags = Tag::factory(10)->create();

        // 4. Buat 20 Postingan Dummy
        Post::factory(20)
            ->recycle($users = User::factory(5)->create(['role_id' => $userRole->id])) // Pakai user yang baru dibuat
            ->recycle($categories) // Pakai kategori yang sudah ada
            ->create()
            ->each(function ($post) use ($tags) {
                // Attach tags secara acak ke setiap post
                $post->tags()->attach($tags->random(rand(1, 3)));
            });

        // 5. Buat Komentar Dummy
        Comment::factory(50)->recycle($users)->recycle(Post::all())->create();
    }
}