<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'FXFLARE | AI-Powered Market Intelligence' }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-darkbg text-white font-sans antialiased selection:bg-accent selection:text-white">

    <!-- Toast Notification -->
    <!-- Toast Notification System -->
    <div x-data="{ 
            notifications: [],
            add(e) {
                this.notifications.push({
                    id: Date.now(),
                    type: e.detail.type || 'info',
                    title: e.detail.title || 'Info',
                    message: e.detail.message,
                    show: true
                });
            },
            remove(id) {
                const index = this.notifications.findIndex(n => n.id === id);
                if (index > -1) {
                    this.notifications[index].show = false;
                    setTimeout(() => {
                        this.notifications = this.notifications.filter(n => n.id !== id);
                    }, 300);
                }
            }
        }" @notify.window="add($event)"
        class="fixed top-24 right-5 z-50 w-full max-w-sm space-y-4 pointer-events-none">

        <!-- Server-side Session Flash -->
        @if(session('notification') || session('success') || session('error'))
            <div x-init="
                                    $dispatch('notify', { 
                                        type: '{{ session('error') ? 'error' : (session('success') ? 'success' : 'info') }}',
                                        title: '{{ session('error') ? 'Error' : (session('success') ? 'Success' : 'Info') }}',
                                        message: '{{ session('error') ?? session('success') ?? session('notification')['message'] ?? '' }}' 
                                    })
                                "></div>
        @endif

        <template x-for="note in notifications" :key="note.id">
            <div x-show="note.show" x-init="setTimeout(() => remove(note.id), 5000)"
                x-transition:enter="transform ease-out duration-300 transition"
                x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg shadow-lg border backdrop-blur-md"
                :class="{
                    'bg-green-500/10 border-green-500/50 text-green-400': note.type === 'success',
                    'bg-red-500/10 border-red-500/50 text-red-400': note.type === 'error',
                    'bg-yellow-500/10 border-yellow-500/50 text-yellow-400': note.type === 'warning',
                    'bg-blue-500/10 border-blue-500/50 text-blue-400': note.type === 'info'
                 }" role="alert">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <!-- Icons based on type -->
                            <svg x-show="note.type === 'success'" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <svg x-show="note.type === 'error'" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <svg x-show="note.type === 'info'" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <svg x-show="note.type === 'warning'" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p class="text-sm font-medium" x-text="note.title"></p>
                            <p class="mt-1 text-sm opacity-90" x-text="note.message"></p>
                        </div>
                        <div class="ml-4 flex flex-shrink-0">
                            <button @click="remove(note.id)" type="button"
                                class="inline-flex rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-gray-500 hover:bg-white/10">
                                <span class="sr-only">Close</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>


    <!-- NAVBAR -->
    <!-- NAVBAR -->
    <nav class="border-b border-gray-800 bg-darkbg/80 backdrop-blur-md sticky top-0 z-50"
        x-data="{ mobileOpen: false }">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <span class="text-xl font-bold tracking-wide text-white">
                FXFLARE <span
                    class="text-xs font-normal text-accent ml-1 uppercase tracking-widest border border-accent rounded px-1">AI-Powered</span>
            </span>

            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-8 text-sm font-medium text-gray-400">
                <a href="/" class="hover:text-white transition">Home</a>
                <a href="{{ route('reports.index') }}" class="hover:text-white transition">Markets</a>
                <a href="{{ route('news.index') }}" class="hover:text-white transition">News</a>
                <a href="#" class="hover:text-white transition">Analysis</a>
                <a href="{{ route('watchlist.index') }}" class="hover:text-white transition">Watchlist</a>
                <a href="#" class="hover:text-white transition text-accent">Premium</a>
            </div>

            <!-- Desktop Right Side (User/Auth) -->
            <div class="hidden md:block">
                @auth
                    <div class="relative group" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-2 text-sm font-semibold hover:text-white transition px-4 py-2 rounded-lg hover:bg-gray-800">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <!-- Dropdown -->
                        <div x-show="open" @click.away="open = false" x-transition style="display: none;"
                            class="absolute right-0 mt-2 w-48 bg-darkcard border border-gray-800 rounded-xl shadow-xl overflow-hidden z-50">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-800 hover:text-white">Profile</a>
                            @if(Auth::user()->role->name === 'admin')
                                <a href="{{ route('admin.index') }}"
                                    class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-800 hover:text-white">Dashboard</a>
                            @endif
                            <div class="border-t border-gray-800"></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-gray-800 hover:text-red-300">
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm font-semibold hover:text-white transition px-4 py-2 rounded-lg hover:bg-gray-800">Sign
                        In</a>
                @endauth
            </div>

            <!-- Mobile Hamburger Button -->
            <button @click="mobileOpen = !mobileOpen"
                class="md:hidden text-gray-400 hover:text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                    <path x-show="mobileOpen" style="display: none;" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileOpen" x-transition style="display: none;"
            class="md:hidden bg-darkcard border-t border-gray-800">
            <div class="px-4 py-4 space-y-2">
                <a href="/"
                    class="block px-4 py-2 text-base font-medium text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg">Home</a>
                <a href="{{ route('reports.index') }}"
                    class="block px-4 py-2 text-base font-medium text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg">Markets</a>
                <a href="{{ route('news.index') }}"
                    class="block px-4 py-2 text-base font-medium text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg">News</a>
                <a href="#"
                    class="block px-4 py-2 text-base font-medium text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg">Analysis</a>
                <a href="{{ route('watchlist.index') }}"
                    class="block px-4 py-2 text-base font-medium text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg">Watchlist</a>
                <a href="#"
                    class="block px-4 py-2 text-base font-medium text-accent hover:text-white hover:bg-gray-800 rounded-lg">Premium</a>

                @auth
                    <div class="border-t border-gray-700 my-2"></div>
                    <div class="px-4 py-2 text-sm text-gray-500">Logged in as {{ Auth::user()->name }}</div>
                    <a href="{{ route('profile.edit') }}"
                        class="block px-4 py-2 text-base font-medium text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg">Profile</a>
                    @if(Auth::user()->role->name === 'admin')
                        <a href="{{ route('admin.index') }}"
                            class="block px-4 py-2 text-base font-medium text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg">Dashboard</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-base font-medium text-red-400 hover:text-red-300 hover:bg-gray-800 rounded-lg">
                            Sign Out
                        </button>
                    </form>
                @else
                    <div class="border-t border-gray-700 my-2"></div>
                    <a href="{{ route('login') }}"
                        class="block px-4 py-2 text-base font-medium text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg">Sign
                        In</a>
                @endauth
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
            © 2025 FXFLARE. All rights reserved. Financial data provided by various sources.
            <br>
            <span class="text-xs text-gray-600 mt-2 block">FXFLARE is not a broker-dealer or investment advisor. We
                provide information, not investment advice.</span>
        </div>
    </footer>

</body>

</html>