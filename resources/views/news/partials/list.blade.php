@if($posts->count() > 0)
    <div class="grid md:grid-cols-2 gap-6">
        @foreach($posts as $post)
            <article class="bg-darkcard rounded-xl overflow-hidden border border-gray-800 hover:border-gray-700 transition flex flex-col group">
                <a href="{{ route('news.show', $post->slug) }}" class="block overflow-hidden relative aspect-video">
                    @if($post->thumbnail)
                        <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <!-- Placeholder if no thumbnail -->
                        <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                            <span class="text-gray-600 font-bold text-lg">No Image</span>
                        </div>
                    @endif
                    @if($post->category)
                        <span class="absolute top-3 left-3 px-2 py-1 bg-accent text-white text-xs font-bold rounded uppercase tracking-wider">
                            {{ $post->category->name }}
                        </span>
                    @endif
                </a>
                <div class="p-5 flex-1 flex flex-col">
                    <div class="flex items-center gap-2 text-xs text-silver mb-3">
                        <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : 'Draft' }}</span>
                        <span>•</span>
                        <span>{{ $post->user->name ?? 'Admin' }}</span>
                    </div>
                    <h2 class="text-xl font-bold text-white mb-3 leading-tight group-hover:text-accent transition">
                        <a href="{{ route('news.show', $post->slug) }}">{{ $post->title }}</a>
                    </h2>
                    <p class="text-gray-400 text-sm mb-4 line-clamp-3">
                        {{ Str::limit(strip_tags($post->content), 120) }}
                    </p>
                    
                    <div class="mt-auto">
                        @if($post->tags->count() > 0)
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($post->tags->take(3) as $tag)
                                    <a href="{{ route('news.index', ['tag' => $tag->slug]) }}" class="text-xs text-gray-500 hover:text-white transition">#{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </article>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-12">
        {{ $posts->links() }} 
    </div>

@else
    <div class="bg-darkcard border border-gray-800 rounded-xl p-12 text-center">
        <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
        </svg>
        <h3 class="text-xl font-bold text-white mb-2">No News Found</h3>
        <p class="text-gray-400 mb-6">We couldn't find any articles matching your criteria.</p>
        <a href="{{ route('news.index') }}" class="px-6 py-2 bg-accent text-white rounded-lg hover:bg-accent-hover transition">
            Clear Filters
        </a>
    </div>
@endif
