<div class="relative bg-darkbg overflow-hidden py-16 md:py-24">
    <div class="absolute inset-0 z-0">
        <!-- Abstract Glow -->
        <div
            class="absolute top-0 left-1/2 transform -translate-x-1/2 w-[800px] h-[400px] bg-accent/20 rounded-full blur-[100px] opacity-20 pointer-events-none">
        </div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 text-center">
        <div
            class="inline-block mb-4 px-3 py-1 bg-gray-800 rounded-full text-xs font-semibold text-accent tracking-widest uppercase">
            AI-Powered
        </div>
        <h1 class="text-5xl md:text-7xl font-bold text-white tracking-tight mb-6">
            AI-Powered <br class="hidden md:block" />
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-purple-600">
                Market Intelligence
            </span>
        </h1>

        <p class="text-xl text-gray-400 mb-10 max-w-2xl mx-auto leading-relaxed">
            Get real-time financial news, sentiment analysis, and smart summaries tailored for traders.
        </p>

        <div class="max-w-2xl mx-auto relative group" 
             x-data="{ 
                query: '', 
                results: [], 
                open: false,
                search() {
                    if (this.query.length < 2) { 
                        this.results = []; 
                        this.open = false; 
                        return; 
                    }
                    fetch(`{{ route('search.index') }}?query=${this.query}`)
                        .then(res => res.json())
                        .then(data => {
                            this.results = data;
                            this.open = true;
                        });
                }
             }"
             @click.away="open = false">
            <div
                class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full opacity-20 group-hover:opacity-40 transition duration-500 blur">
            </div>
            
            <!-- Input Area -->
            <div class="relative flex items-center">
                <input type="text" x-model="query" @input.debounce.300ms="search()" 
                    placeholder="Search news..."
                    class="w-full bg-[#1E1E1E] border border-gray-700 text-white rounded-full py-4 pl-8 pr-32 focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent shadow-2xl text-lg placeholder-gray-500 transition-all">
                <button
                    class="absolute right-2 top-2 bottom-2 bg-accent hover:bg-purple-600 text-white rounded-full px-8 font-semibold transition-all shadow-lg hover:shadow-purple-500/25">
                    Search
                </button>
            </div>

            <!-- Dropdown Results -->
            <div x-show="open && results.length > 0" 
                 x-transition
                 style="display: none;"
                 class="absolute top-16 left-0 right-0 bg-darkcard border border-gray-800 rounded-xl shadow-2xl overflow-hidden z-50">
                <template x-for="result in results" :key="result.url">
                    <a :href="result.url" class="block px-4 py-3 hover:bg-gray-800 border-b border-gray-800/50 last:border-0 transition text-left">
                        <div class="text-white font-medium text-sm" x-text="result.title"></div>
                        <div class="text-xs text-accent mt-1" x-text="result.category"></div>
                    </a>
                </template>
            </div>
            
            <div x-show="open && results.length === 0 && query.length >= 2" 
                 class="absolute top-16 left-0 right-0 bg-darkcard border border-gray-800 rounded-xl shadow-xl p-4 text-gray-500 z-50">
                No news found.
            </div>
        </div>

        <!-- Quick Tags -->
        <div class="mt-8 flex justify-center gap-4 text-sm text-gray-500">
            <span>Trending:</span>
            <a href="#" class="hover:text-accent transition">EUR/USD</a>
            <a href="#" class="hover:text-accent transition">Bitcoin</a>
            <a href="#" class="hover:text-accent transition">NVIDIA</a>
            <a href="#" class="hover:text-accent transition">Gold</a>
        </div>
    </div>
</div>