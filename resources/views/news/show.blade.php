<x-layout>
    <x-slot:title>
        {{ $post->title }} | FXFLARE
    </x-slot:title>

    <div class="max-w-4xl mx-auto px-6 py-12">
        <div class="mb-8">
            <a href="{{ route('news.index') }}" class="text-gray-400 hover:text-white transition flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to News
            </a>
            
            <div class="flex items-center gap-2 text-sm text-accent font-bold uppercase tracking-wider mb-3">
                @if($post->category)
                    <span>{{ $post->category->name }}</span>
                @endif
                <span class="text-gray-600">•</span>
                <span class="text-gray-400">{{ $post->published_at ? $post->published_at->format('M d, Y') : 'Draft' }}</span>
            </div>

            <h1 class="text-3xl md:text-5xl font-bold text-white mb-6 leading-tight">{{ $post->title }}</h1>

            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center text-white font-bold">
                    {{ substr($post->user->name ?? 'A', 0, 1) }}
                </div>
                <div>
                    <div class="text-white font-medium">{{ $post->user->name ?? 'admin' }}</div>
                    <div class="text-xs text-gray-500">Author</div>
                </div>
            </div>
        </div>

        @if($post->thumbnail)
            <div class="rounded-xl overflow-hidden mb-10 border border-gray-800">
                <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-auto object-cover">
            </div>
        @endif

        <article class="prose prose-invert prose-lg max-w-none text-gray-300">
            {!! nl2br(e($post->content)) !!}
        </article>

        <div class="mt-12 pt-8 border-t border-gray-800">
            <h3 class="text-lg font-bold text-white mb-4">Tags</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($post->tags as $tag)
                    <a href="{{ route('news.index', ['tag' => $tag->slug]) }}" class="px-3 py-1 bg-darkcard border border-gray-700 rounded-full text-sm text-gray-400 hover:text-white hover:border-gray-500 transition">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
