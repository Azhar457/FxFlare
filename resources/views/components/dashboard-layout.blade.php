<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'FXFLARE | Admin Dashboard' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-900 text-white font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 border-r border-gray-700 hidden md:flex flex-col">
            <div class="h-16 flex items-center px-6 border-b border-gray-700">
                <a href="/" class="text-xl font-bold tracking-wide text-white">
                    FXFLARE <span class="text-xs text-accent uppercase border border-accent rounded px-1 ml-1">Admin</span>
                </a>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.index') }}" 
                   class="flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.index') ? 'bg-accent text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }} mb-4">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>

                <p class="px-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Management</p>
                
                <a href="{{ route('admin.posts.index') }}" 
                   class="flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.posts.*') ? 'bg-accent text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    Posts
                </a>

                <a href="{{ route('admin.categories.index') }}" 
                   class="flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-accent text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    Categories
                </a>

                <a href="{{ route('admin.tags.index') }}" 
                   class="flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.tags.*') ? 'bg-accent text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                    Tags
                </a>

                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-accent text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Users
                </a>

                <div class="border-t border-gray-700 my-4"></div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-4 py-2 text-sm font-medium text-red-400 hover:bg-gray-700 hover:text-red-300 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Sign Out
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Topbar (Mobile only mostly, or just user info) -->
            <header class="bg-gray-800 border-b border-gray-700 h-16 flex items-center justify-between px-6 md:hidden">
                <span class="text-lg font-bold">FXFLARE Admin</span>
                <!-- Mobile menu button could go here -->
            </header>

            <!-- Scrollable Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-900 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

</body>
</html>
