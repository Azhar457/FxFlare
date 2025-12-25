<x-dashboard-layout>
    <x-slot:title>
        Dashboard | FXFLARE Admin
    </x-slot:title>

    <div class="px-6 py-8">
        <h1 class="text-3xl font-bold text-white mb-8">Dashboard Overview</h1>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Posts Stats -->
            <div class="bg-darkcard border border-gray-800 rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-400 text-sm uppercase font-bold tracking-wider">Total Posts</h3>
                    <div class="p-2 bg-blue-500/10 rounded-lg">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-bold text-white">{{ $stats['posts'] }}</span>
                    <span class="text-sm text-green-400">+{{ $latestPosts->count() }} new</span>
                </div>
            </div>

            <!-- Users Stats -->
            <div class="bg-darkcard border border-gray-800 rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-400 text-sm uppercase font-bold tracking-wider">Total Users</h3>
                    <div class="p-2 bg-purple-500/10 rounded-lg">
                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-bold text-white">{{ $stats['users'] }}</span>
                    <span class="text-sm text-green-400">+{{ $latestUsers->count() }} new</span>
                </div>
            </div>

            <!-- Categories Stats -->
            <div class="bg-darkcard border border-gray-800 rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-400 text-sm uppercase font-bold tracking-wider">Categories</h3>
                    <div class="p-2 bg-yellow-500/10 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-bold text-white">{{ $stats['categories'] }}</span>
                    <span class="text-sm text-gray-500">Active</span>
                </div>
            </div>

            <!-- Tags Stats -->
            <div class="bg-darkcard border border-gray-800 rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-400 text-sm uppercase font-bold tracking-wider">Tags</h3>
                    <div class="p-2 bg-pink-500/10 rounded-lg">
                        <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-bold text-white">{{ $stats['tags'] }}</span>
                    <span class="text-sm text-gray-500">Topics</span>
                </div>
            </div>
        </div>

        <!-- NEW STATS -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Comments Stats -->
            <div class="bg-darkcard border border-gray-800 rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-400 text-sm uppercase font-bold tracking-wider">Total Comments</h3>
                    <div class="p-2 bg-teal-500/10 rounded-lg">
                        <svg class="w-6 h-6 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-bold text-white">{{ $stats['comments'] }}</span>
                    <span class="text-sm text-gray-500">Global</span>
                </div>
            </div>

            <!-- Likes Stats -->
            <div class="bg-darkcard border border-gray-800 rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-400 text-sm uppercase font-bold tracking-wider">Total Likes</h3>
                    <div class="p-2 bg-red-500/10 rounded-lg">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-bold text-white">{{ $stats['likes'] }}</span>
                    <span class="text-sm text-gray-500">Across posts</span>
                </div>
            </div>
        </div>


        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Latest Posts -->
            <div class="bg-darkcard border border-gray-800 rounded-xl p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-white">Latest Posts</h3>
                    <a href="{{ route('admin.posts.index') }}" class="text-sm text-accent hover:text-white transition">View All</a>
                </div>
                <div class="space-y-4">
                    @forelse($latestPosts as $post)
                        <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-gray-800/50 transition">
                            @if($post->thumbnail)
                                <img src="{{ Storage::url($post->thumbnail) }}" class="w-12 h-12 rounded object-cover">
                            @else
                                <div class="w-12 h-12 rounded bg-gray-700 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-white truncate">{{ $post->title }}</h4>
                                <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}</p>
                            </div>
                            <span class="px-2 py-1 text-xs rounded border {{ $post->status === 'published' ? 'border-green-500 text-green-500' : 'border-yellow-500 text-yellow-500' }}">
                                {{ $post->status }}
                            </span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">No recent posts.</p>
                    @endforelse
                </div>
            </div>

            <!-- Latest Users -->
            <div class="bg-darkcard border border-gray-800 rounded-xl p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-white">Latest Users</h3>
                    <a href="{{ route('admin.users.index') }}" class="text-sm text-accent hover:text-white transition">View All</a>
                </div>
                <div class="space-y-4">
                    @forelse($latestUsers as $user)
                        <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-gray-800/50 transition">
                            <div class="w-10 h-10 rounded-full bg-accent/20 text-accent flex items-center justify-center font-bold">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-medium text-white">{{ $user->name }}</h4>
                                <p class="text-xs text-gray-500">{{ $user->email }}</p>
                            </div>
                            <span class="text-xs text-gray-400">{{ $user->created_at->format('M d') }}</span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">No recent users.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
