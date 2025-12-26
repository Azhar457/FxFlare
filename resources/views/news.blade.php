<x-layout>
    <x-slot:title>
        Market News | FXFLARE
    </x-slot:title>

    <div class="max-w-7xl mx-auto px-6 py-12">

        <!-- Page Header -->
        <div class="mb-10 text-center md:text-left grid md:grid-cols-[1fr_auto] gap-6 items-end">
            <div>
                <h1 class="text-4xl font-bold text-white mb-2">Market News</h1>
                <p class="text-gray-400">Stay updated with the latest financial insights, crypto trends, and forex analysis.</p>
            </div>
            
            <!-- Mobile Search (Visible only on small screens if desired, but we'll stick to sidebar for desktop consistency) -->
        </div>

        <div class="grid lg:grid-cols-[1fr_300px] gap-12">
            
            <!-- Main Content -->
            <main id="news-container">
                @include('news.partials.list')
            </main>

            <!-- Sidebar -->
            <aside class="space-y-8">
                
                <!-- Search Widget -->
                <div class="bg-darkcard p-6 rounded-xl border border-gray-800">
                    <h3 class="text-lg font-bold text-white mb-4">Search News</h3>
                    <form action="{{ route('news.index') }}" method="GET" id="search-form">
                        <!-- Preserve other filters -->
                        @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                        @if(request('tag')) <input type="hidden" name="tag" value="{{ request('tag') }}"> @endif
                        
                        <div class="relative">
                            <input type="text" name="search" id="search-input" value="{{ request('search') }}" placeholder="Search articles..." 
                                class="w-full bg-darkbg border border-gray-700 text-white rounded-lg pl-4 pr-10 py-2 focus:outline-none focus:border-accent transition placeholder-gray-500">
                            <button type="submit" class="absolute right-3 top-2.5 text-gray-400 hover:text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Categories Widget -->
                <div class="bg-darkcard p-6 rounded-xl border border-gray-800">
                    <h3 class="text-lg font-bold text-white mb-4">Categories</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('news.index') }}" 
                               class="flex justify-between items-center group {{ !request('category') ? 'text-accent' : 'text-gray-400 hover:text-white' }}">
                                <span>All Categories</span>
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('news.index', ['category' => $category->slug] + request()->except('category', 'page')) }}" 
                                   class="flex justify-between items-center group {{ request('category') == $category->slug ? 'text-accent' : 'text-gray-400 hover:text-white' }}">
                                    <span>{{ $category->name }}</span>
                                    <span class="text-xs bg-gray-800 px-2 py-0.5 rounded-full {{ request('category') == $category->slug ? 'text-white' : 'text-gray-500 group-hover:text-gray-300' }}">
                                        {{ $category->posts_count }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Tags Widget -->
                <div class="bg-darkcard p-6 rounded-xl border border-gray-800">
                    <h3 class="text-lg font-bold text-white mb-4">Trending Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <a href="{{ route('news.index', ['tag' => $tag->slug] + request()->except('tag', 'page')) }}" 
                               class="px-3 py-1 text-xs rounded-full border transition
                                      {{ request('tag') == $tag->slug 
                                         ? 'bg-accent/10 border-accent text-accent' 
                                         : 'bg-darkbg border-gray-700 text-gray-400 hover:border-gray-500 hover:text-white' }}">
                                #{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

            </aside>

        </div>
    </div>

    <script>
        const searchInput = document.getElementById('search-input');
        const newsContainer = document.getElementById('news-container');
        const searchForm = document.getElementById('search-form');

        let timeout = null;

        searchInput.addEventListener('keyup', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                const formData = new FormData(searchForm);
                // Update the search value in formData manually to be sure
                formData.set('search', this.value); 
                
                const params = new URLSearchParams(formData);

                fetch(`{{ route('news.index') }}?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    newsContainer.innerHTML = html;
                });
            }, 300);
        });

        // Prevent form submit on enter to just let ajax handle or normal submit?
        // Let's allow normal submit if enter is pressed, but the keyup handles live.
        searchForm.addEventListener('submit', function(e) {
             // Optional: prevent default if we want pure SPA feel, but standard submit is fine too.
        });
    </script>
</x-layout>
