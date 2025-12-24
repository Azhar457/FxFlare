<x-dashboard-layout>
    <x-slot:title>
        Manage Users | FXFLARE
    </x-slot:title>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-white">Manage Users</h1>
            <a href="{{ route('admin.users.create') }}" class="bg-accent hover:bg-accent/80 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                + Add New User
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-900/50 border border-green-800 text-green-200 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-darkcard border border-gray-800 rounded-xl p-6 shadow-xl" x-data="{ search: '' }">
            <div class="mb-6">
                <input 
                    type="text" 
                    placeholder="Search users by name or email..." 
                    class="w-full bg-darkbg border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent"
                    x-model="search"
                    @input.debounce.500ms="
                        fetch('{{ route('admin.users.index') }}?search=' + search, {
                            headers: { 'X-Requested-With': 'XMLHttpRequest' }
                        })
                        .then(res => res.text())
                        .then(html => $refs.usersTable.innerHTML = html)
                    "
                >
            </div>

            <div x-ref="usersTable">
                @include('dashboard.users.partials.users-table', ['users' => $users])
            </div>
        </div>
    </div>
</x-dashboard-layout>
