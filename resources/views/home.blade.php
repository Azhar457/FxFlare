<x-layout>
    <x-slot:title>
        Home | FXFLARE
    </x-slot:title>

    {{-- Section 1: Hero --}}
    <x-hero />

    {{-- Section 2: Marquee --}}
    <x-marquee />

    <div class="max-w-7xl mx-auto px-6 py-12">

        {{-- Section 3: Market Overview (Cards) --}}
        <x-market-table />

        {{-- Section 4: Latest News (Carousel) --}}
        <section class="mb-16">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-white">Latest Market News</h2>
                <div class="flex space-x-2 text-sm">
                    <button
                        class="px-3 py-1 bg-gray-800 rounded-full text-white hover:bg-gray-700 transition">All</button>
                    <button class="px-3 py-1 text-gray-400 hover:text-white transition">Forex</button>
                    <button class="px-3 py-1 text-gray-400 hover:text-white transition">Crypto</button>
                    <button class="px-3 py-1 text-gray-400 hover:text-white transition">Stocks</button>
                </div>
            </div>
            <x-carousel />
            <div class="text-center mt-6">
                <button
                    class="text-accent hover:text-white transition font-medium text-sm flex items-center justify-center gap-2 mx-auto">
                    Load More News <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>
        </section>

        {{-- Section 5: Market Sentiment & Premium CTA --}}
        <x-sentiment />

        {{-- Section 6: Trending Topics (Plain HTML or new component) --}}
        <section>
            <h2 class="text-2xl font-bold text-white mb-6">Trending Topics</h2>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                <div
                    class="bg-gray-800/50 p-4 rounded-xl border border-gray-700/50 text-center hover:bg-gray-800 transition cursor-pointer">
                    <div class="text-sm text-gray-400 mb-1">Fed Rate Decision</div>
                    <div class="text-xl font-bold text-green-500">+1,245%</div>
                </div>
                <div
                    class="bg-gray-800/50 p-4 rounded-xl border border-gray-700/50 text-center hover:bg-gray-800 transition cursor-pointer">
                    <div class="text-sm text-gray-400 mb-1">Bitcoin ETF</div>
                    <div class="text-xl font-bold text-green-500">+892%</div>
                </div>
                <div
                    class="bg-gray-800/50 p-4 rounded-xl border border-gray-700/50 text-center hover:bg-gray-800 transition cursor-pointer">
                    <div class="text-sm text-gray-400 mb-1">Tech Earnings</div>
                    <div class="text-xl font-bold text-green-500">+567%</div>
                </div>
                <div
                    class="bg-gray-800/50 p-4 rounded-xl border border-gray-700/50 text-center hover:bg-gray-800 transition cursor-pointer">
                    <div class="text-sm text-gray-400 mb-1">Oil Prices</div>
                    <div class="text-xl font-bold text-green-500">+432%</div>
                </div>
                <div
                    class="bg-gray-800/50 p-4 rounded-xl border border-gray-700/50 text-center hover:bg-gray-800 transition cursor-pointer">
                    <div class="text-sm text-gray-400 mb-1">China GDP</div>
                    <div class="text-xl font-bold text-green-500">+321%</div>
                </div>
            </div>
        </section>

    </div>
</x-layout>