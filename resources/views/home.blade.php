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
            <h2 class="text-2xl font-bold text-white mb-6">Latest Market News</h2>
            <x-carousel />

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