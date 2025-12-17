@props(['post'])

<a href="#" class="block">
    <article class="bg-darkcard rounded-lg overflow-hidden shadow-2xl border border-gray-800 h-full 
                    transform transition duration-300 hover:scale-[1.02] hover:border-accent">
        
        {{-- Thumbnail --}}
        <div class="relative w-full h-48 bg-gray-800">
            {{-- Menggunakan thumbnail dari data dummy --}}
            <img src="{{ $post->thumbnail }}" 
                 alt="{{ $post->title }}" 
                 class="w-full h-full object-cover">
        </div>
        
        <div class="p-5 flex flex-col justify-between flex-grow">
            <div>
                {{-- Kategori --}}
                <span class="text-accent text-xs font-semibold uppercase tracking-wider hover:text-white transition">
                    {{ $post->category['name'] }}
                </span>
                
                {{-- Judul --}}
                <h3 class="text-xl font-bold text-white mt-2 mb-3 line-clamp-2 leading-snug">
                    {{ $post->title }}
                </h3>
                
                {{-- Ringkasan Konten --}}
                <p class="text-silver text-sm line-clamp-3">
                    {{ Str::limit($post->content, 100) }}
                </p>
            </div>

            {{-- Metadata --}}
            <div class="mt-4 pt-4 border-t border-gray-700 text-xs text-gray-500">
                <span>Oleh: <span class="text-silver font-medium">{{ $post->user['name'] }}</span></span>
                <span class="mx-2">•</span>
                <span>{{ $post->published_at->format('d M Y') }}</span>
            </div>
        </div>
    </article>
</a>