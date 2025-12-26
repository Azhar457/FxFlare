<section class="mb-16">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white flex items-center gap-2">
            <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                </path>
            </svg>
            Market Overview
        </h2>
        <div class="text-xs text-gray-500">
            Last updated: {{ date('h:i:s A') }} GMT+7
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">

        <!-- EUR/USD -->
        <div class="bg-darkcard p-4 rounded-xl border border-gray-800 hover:border-gray-600 transition group">
            <div class="text-xs text-gray-400 mb-1 group-hover:text-white transition">EUR/USD</div>
            <div class="font-bold text-lg text-white mb-2">Euro / USD</div>
            <div class="flex items-center justify-between">
                <span class="text-green-500 font-bold text-sm">+0.24%</span>
                <span class="text-gray-300 text-sm">1.0924</span>
            </div>
        </div>

        <!-- BTC/USD -->
        <div class="bg-darkcard p-4 rounded-xl border border-gray-800 hover:border-gray-600 transition group">
            <div class="text-xs text-gray-400 mb-1 group-hover:text-white transition">BTC/USD</div>
            <div class="font-bold text-lg text-white mb-2">Bitcoin</div>
            <div class="flex items-center justify-between">
                <span class="text-green-500 font-bold text-sm">+0.57%</span>
                <span class="text-gray-300 text-sm">42,156</span>
            </div>
        </div>

        <!-- S&P 500 -->
        <div class="bg-darkcard p-4 rounded-xl border border-gray-800 hover:border-gray-600 transition group">
            <div class="text-xs text-gray-400 mb-1 group-hover:text-white transition">SPX</div>
            <div class="font-bold text-lg text-white mb-2">S&P 500</div>
            <div class="flex items-center justify-between">
                <span class="text-green-500 font-bold text-sm">+0.68%</span>
                <span class="text-gray-300 text-sm">4,567</span>
            </div>
        </div>

        <!-- Gold -->
        <div class="bg-darkcard p-4 rounded-xl border border-gray-800 hover:border-gray-600 transition group">
            <div class="text-xs text-gray-400 mb-1 group-hover:text-white transition">XAU/USD</div>
            <div class="font-bold text-lg text-white mb-2">Gold</div>
            <div class="flex items-center justify-between">
                <span class="text-red-500 font-bold text-sm">-0.74%</span>
                <span class="text-gray-300 text-sm">2,034</span>
            </div>
        </div>

        <!-- USD/JPY -->
        <div class="bg-darkcard p-4 rounded-xl border border-gray-800 hover:border-gray-600 transition group">
            <div class="text-xs text-gray-400 mb-1 group-hover:text-white transition">USD/JPY</div>
            <div class="font-bold text-lg text-white mb-2">Yen</div>
            <div class="flex items-center justify-between">
                <span class="text-red-500 font-bold text-sm">-0.33%</span>
                <span class="text-gray-300 text-sm">143.25</span>
            </div>
        </div>

        <!-- NASDAQ -->
        <div class="bg-darkcard p-4 rounded-xl border border-gray-800 hover:border-gray-600 transition group">
            <div class="text-xs text-gray-400 mb-1 group-hover:text-white transition">NDX</div>
            <div class="font-bold text-lg text-white mb-2">NASDAQ</div>
            <div class="flex items-center justify-between">
                <span class="text-green-500 font-bold text-sm">+0.92%</span>
                <span class="text-gray-300 text-sm">15,678</span>
            </div>
        </div>

    </div>
</section>