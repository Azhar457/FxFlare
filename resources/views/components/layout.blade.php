<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'FXFLARE | AI-Powered Market Intelligence' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-darkbg text-white font-sans antialiased selection:bg-accent selection:text-white">

    <!-- NAVBAR -->
    <nav class="border-b border-gray-800 bg-darkbg/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <span class="text-xl font-bold tracking-wide text-white">
                FXFLARE <span
                    class="text-xs font-normal text-accent ml-1 uppercase tracking-widest border border-accent rounded px-1">AI-Powered</span>
            </span>

            <div class="hidden md:flex space-x-8 text-sm font-medium text-gray-400">
                <a href="/" class="hover:text-white transition">Home</a>
                <a href="#" class="hover:text-white transition">Markets</a>
                <a href="{{ route('news.index') }}" class="hover:text-white transition">News</a>
                <a href="#" class="hover:text-white transition">Analysis</a>
                <a href="#" class="hover:text-white transition">Watchlist</a>
                <a href="#" class="hover:text-white transition text-accent">Premium</a>
            </div>

            <div>
                <a href="/login"
                    class="text-sm font-semibold hover:text-white transition px-4 py-2 rounded-lg hover:bg-gray-800">Sign
                    In</a>
            </div>
        </div>
    </nav>

    <!-- SLOT CONTENT -->
    <main>
        {{ $slot }}
    </main>

    <!-- FOOTER -->
    <footer class="border-t border-gray-800 bg-[#0a0a0a] py-12 text-sm text-gray-500">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <div>
                <h4 class="text-white font-bold text-lg mb-4">FXFLARE</h4>
                <p class="mb-4">AI-powered market intelligence for traders and investors.</p>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4">Markets</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-accent">Forex</a></li>
                    <li><a href="#" class="hover:text-accent">Cryptocurrencies</a></li>
                    <li><a href="#" class="hover:text-accent">Stocks</a></li>
                    <li><a href="#" class="hover:text-accent">Commodities</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4">Company</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-accent">About Us</a></li>
                    <li><a href="#" class="hover:text-accent">Careers</a></li>
                    <li><a href="#" class="hover:text-accent">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4">Legal</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-accent">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-accent">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-accent">Risk Disclosure</a></li>
                </ul>
            </div>
        </div>
        <div class="text-center border-t border-gray-900 pt-8">
            © 2023 FXFLARE. All rights reserved. Financial data provided by various sources.
            <br>
            <span class="text-xs text-gray-600 mt-2 block">FXFLARE is not a broker-dealer or investment advisor. We
                provide information, not investment advice.</span>
        </div>
    </footer>

</body>

</html>