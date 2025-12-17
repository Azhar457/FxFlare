@props(['posts']) {{-- Asumsi menerima koleksi posts --}}

<section class="py-12">
    <h2 class="text-3xl font-bold text-white mb-8 border-b border-gray-700 pb-3">Artikel Terpilih</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        {{-- Menggunakan loop x-article-card yang sudah kita buat --}}
        @foreach ($posts as $post)
            <x-article-card :post="$post" />
        @endforeach
    </div>
</section>