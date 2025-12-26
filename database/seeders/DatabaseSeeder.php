<?php

namespace Database\Seeders;

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
        // 1. Buat Role Spesifik
        $adminRole = Role::factory()->create(['name' => 'admin']);
        $userRole = Role::factory()->create(['name' => 'user']);
        
        // 2. Buat 1 User Admin (untuk kamu login nanti)
        User::factory()->create([
            'name' => 'Azhar Admin',
            'email' => 'admin@fxflare.com',
            'password' => bcrypt('password'), // password default
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