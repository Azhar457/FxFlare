@props(['id' => 'default-carousel'])

<div class="relative w-full overflow-hidden" x-data="{ activeSlide: 0, slides: [0, 1, 2] }">
    <!-- Carousel Wrapper -->
    <div class="relative min-h-[300px] md:min-h-[200px] overflow-hidden rounded-lg">

        <!-- Slide 1 -->
        <div x-show="activeSlide === 0" class="hidden duration-700 ease-in-out"
            :class="{ 'block': activeSlide === 0, 'hidden': activeSlide !== 0 }" data-carousel-item>
            <div
                class="bg-darkcard p-6 rounded-lg border border-gray-800 grid md:grid-cols-[1fr_auto] gap-6 items-center h-full">
                <div>
                    <div class="flex items-center gap-2 mb-2 text-xs text-silver">
                        <span class="text-accent font-bold">Forex</span>
                        <span>•</span>
                        <span>Reuters • 15 min ago</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Fed Signals Potential Rate Cuts in Q2 2024</h3>
                    <p class="text-gray-400 text-sm mb-4">The Federal Reserve indicated possible rate cuts in the second
                        quarter of 2024, causing immediate volatility in currency markets...</p>
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-1 bg-green-500/10 text-green-500 text-xs rounded font-bold">Bullish</span>
                        <span class="text-xs text-gray-500">EUR/USD, USD/JPY</span>
                    </div>
                </div>
                <button class="bg-gray-800 hover:bg-gray-700 text-white rounded-lg px-4 py-2 text-sm transition">
                    Read AI Summary
                </button>
            </div>
        </div>

        <!-- Slide 2 -->
        <div x-show="activeSlide === 1" class="hidden duration-700 ease-in-out"
            :class="{ 'block': activeSlide === 1, 'hidden': activeSlide !== 1 }" data-carousel-item>
            <div
                class="bg-darkcard p-6 rounded-lg border border-gray-800 grid md:grid-cols-[1fr_auto] gap-6 items-center h-full">
                <div>
                    <div class="flex items-center gap-2 mb-2 text-xs text-silver">
                        <span class="text-orange-500 font-bold">Crypto</span>
                        <span>•</span>
                        <span>Bloomberg • 42 min ago</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">SEC Approves First Spot Bitcoin ETFs</h3>
                    <p class="text-gray-400 text-sm mb-4">The U.S. Securities and Exchange Commission approved the first
                        spot Bitcoin ETFs, marking a significant milestone...</p>
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-1 bg-red-500/10 text-red-500 text-xs rounded font-bold">Bearish</span>
                        <!-- Example from user image said Bearish for 'sell the news' maybe? -->
                        <span class="text-xs text-gray-500">BTC/USD, ETH/USD</span>
                    </div>
                </div>
                <button class="bg-gray-800 hover:bg-gray-700 text-white rounded-lg px-4 py-2 text-sm transition">
                    Read AI Summary
                </button>
            </div>
        </div>

        <!-- Slide 3 -->
        <div x-show="activeSlide === 2" class="hidden duration-700 ease-in-out"
            :class="{ 'block': activeSlide === 2, 'hidden': activeSlide !== 2 }" data-carousel-item>
            <div
                class="bg-darkcard p-6 rounded-lg border border-gray-800 grid md:grid-cols-[1fr_auto] gap-6 items-center h-full">
                <div>
                    <div class="flex items-center gap-2 mb-2 text-xs text-silver">
                        <span class="text-blue-500 font-bold">Stocks</span>
                        <span>•</span>
                        <span>CNBC • 1 hour ago</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Tech Stocks Rally on AI Optimism</h3>
                    <p class="text-gray-400 text-sm mb-4">Major tech companies saw shares rise as investors focused on
                        AI growth potential rather than short-term earnings misses...</p>
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-1 bg-gray-500/10 text-gray-400 text-xs rounded font-bold">Neutral</span>
                        <span class="text-xs text-gray-500">NASDAQ, AAPL</span>
                    </div>
                </div>
                <button class="bg-gray-800 hover:bg-gray-700 text-white rounded-lg px-4 py-2 text-sm transition">
                    Read AI Summary
                </button>
            </div>
        </div>
    </div>

    <!-- Slider controls -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-2 h-2 rounded-full" :class="activeSlide === 0 ? 'bg-accent' : 'bg-gray-600'"
            aria-current="true" aria-label="Slide 1" @click="activeSlide = 0"></button>
        <button type="button" class="w-2 h-2 rounded-full" :class="activeSlide === 1 ? 'bg-accent' : 'bg-gray-600'"
            aria-current="false" aria-label="Slide 2" @click="activeSlide = 1"></button>
        <button type="button" class="w-2 h-2 rounded-full" :class="activeSlide === 2 ? 'bg-accent' : 'bg-gray-600'"
            aria-current="false" aria-label="Slide 3" @click="activeSlide = 2"></button>
    </div>

    <!-- Previous/Next buttons -->
    <button type="button"
        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        @click="activeSlide = activeSlide === 0 ? 2 : activeSlide - 1">
        <span
            class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-800/30 group-hover:bg-gray-800/60 group-focus:ring-2 group-focus:ring-white group-focus:outline-none">
            <svg class="w-3 h-3 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 1 1 5l4 4" />
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button"
        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        @click="activeSlide = activeSlide === 2 ? 0 : activeSlide + 1">
        <span
            class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-800/30 group-hover:bg-gray-800/60 group-focus:ring-2 group-focus:ring-white group-focus:outline-none">
            <svg class="w-3 h-3 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 9 4-4-4-4" />
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>

<!-- Note: Requires Alpine.js for interactivity. Adding cdn to layout. -->