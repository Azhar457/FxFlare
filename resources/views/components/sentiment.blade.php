<section class="mb-16">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sentiment Chart/Stats -->
        <div class="flex-1 bg-darkcard rounded-2xl p-8 border border-gray-800 shadow-2xl">
            <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accent" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Market Sentiment
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="text-center p-4 bg-[#1a1a1a] rounded-xl border border-green-500/20">
                    <div class="text-3xl font-bold text-green-500 mb-1">42%</div>
                    <div class="text-sm text-gray-400">Bullish</div>
                    <div class="w-full bg-gray-800 h-1 mt-3 rounded-full overflow-hidden">
                        <div class="bg-green-500 h-full" style="width: 42%"></div>
                    </div>
                </div>

                <div class="text-center p-4 bg-[#1a1a1a] rounded-xl border border-red-500/20">
                    <div class="text-3xl font-bold text-red-500 mb-1">35%</div>
                    <div class="text-sm text-gray-400">Bearish</div>
                    <div class="w-full bg-gray-800 h-1 mt-3 rounded-full overflow-hidden">
                        <div class="bg-red-500 h-full" style="width: 35%"></div>
                    </div>
                </div>

                <div class="text-center p-4 bg-[#1a1a1a] rounded-xl border border-gray-500/20">
                    <div class="text-3xl font-bold text-gray-400 mb-1">23%</div>
                    <div class="text-sm text-gray-400">Neutral</div>
                    <div class="w-full bg-gray-800 h-1 mt-3 rounded-full overflow-hidden">
                        <div class="bg-gray-500 h-full" style="width: 23%"></div>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Top Bullish Assets</h3>
                <div class="flex items-center justify-between p-3 bg-gray-800/30 rounded-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-green-500"></div>
                        <span class="font-bold">EUR/USD</span>
                    </div>
                    <span class="text-green-500 font-bold">+2.1%</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-800/30 rounded-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-green-500"></div>
                        <span class="font-bold">NASDAQ</span>
                    </div>
                    <span class="text-green-500 font-bold">+1.8%</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-gray-800/30 rounded-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-green-500"></div>
                        <span class="font-bold">Gold</span>
                    </div>
                    <span class="text-green-500 font-bold">+1.5%</span>
                </div>
            </div>
        </div>

        <!-- Premium CTA Panel stuck to Sentiment -->
        <div
            class="flex-1 bg-gradient-to-br from-indigo-900 to-purple-900 rounded-2xl p-8 shadow-2xl relative overflow-hidden flex flex-col justify-center items-center text-center">
            <div class="absolute inset-0 bg-[url('/img/grid.svg')] opacity-10"></div>
            <!-- subtle pattern placeholder -->
            <div class="relative z-10 p-6">
                <div
                    class="inline-block bg-accent/20 text-accent font-bold px-4 py-1 rounded-full text-xs uppercase mb-6 border border-accent/30">
                    Pro Traders Only
                </div>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">FXFLARE Premium</h2>
                <p class="text-indigo-200 mb-8 max-w-md mx-auto">
                    Unlock advanced AI insights, real-time alerts, and exclusive market analysis.
                </p>
                <ul class="text-left space-y-3 mb-8 max-w-xs mx-auto text-sm text-indigo-100">
                    <li class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Advanced Sentiment Analysis
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        AI-Powered Trade Signals
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Real-time Price Alerts
                    </li>
                </ul>
                <button
                    class="w-full bg-white text-indigo-900 font-bold py-4 rounded-xl hover:bg-gray-100 transition shadow-lg transform hover:-translate-y-1">
                    Start 7-Day Free Trial
                </button>
                <p class="text-xs text-indigo-300 mt-4">$29.99/month after trial. Cancel anytime.</p>
            </div>
        </div>
    </div>
</section>