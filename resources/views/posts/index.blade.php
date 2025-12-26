<x-dashboard-layout>
    <x-slot:title>
        Manage Posts | FXFLARE
    </x-slot:title>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">Manage Posts</h1>
                <p class="text-gray-400">Create, edit, and manage news articles.</p>
            </div>
            <a href="{{ route('admin.posts.create') }}" class="px-4 py-2 bg-accent text-white rounded-lg hover:bg-accent-hover transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Create New Post</span>
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-900/50 border border-green-800 text-green-200 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-darkcard border border-gray-800 rounded-xl overflow-hidden">
            <!-- Toolbar -->
            <div class="p-4 border-b border-gray-800 flex justify-end">
                <div class="relative w-full max-w-sm">
                    <input type="text" id="search-input" placeholder="Search posts..." class="w-full bg-darkbg border border-gray-700 text-white rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:border-accent transition placeholder-gray-500">
                    <div class="absolute left-3 top-2.5 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-800/50 text-gray-400 uppercase text-xs font-bold tracking-wider">
                        <tr>
                            <th class="px-6 py-4">#</th>
                            <th class="px-6 py-4">Title</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Author</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800" id="posts-table-body">
                        @include('posts.partials.list', ['posts' => $posts])
                    </tbody>
                </table>
            </div>
            
            @if($posts->count() === 0)
                 <div class="p-8 text-center text-gray-500">
                    No posts found.
                </div>
            @endif
        </div>
    </div>

    <script>
        const searchInput = document.getElementById('search-input');
        const tableBody = document.getElementById('posts-table-body');

        let timeout = null;

        searchInput.addEventListener('keyup', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                const query = this.value;
                fetch(`{{ route('admin.posts.index') }}?search=${query}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    tableBody.innerHTML = html;
                });
            }, 300);
        });
    </script>
</x-dashboard-layout>
