<x-dashboard-layout>
    <x-slot:title>
        Manage Tags | FXFLARE
    </x-slot:title>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-white">Manage Tags</h1>
            <a href="{{ route('admin.tags.create') }}" class="bg-accent hover:bg-accent/80 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                + Add New Tag
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-900/50 border border-green-800 text-green-200 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-darkcard border border-gray-800 rounded-xl p-6 shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-gray-300">
                    <thead class="bg-darkbg/50 uppercase text-xs text-gray-400">
                        <tr>
                            <th class="px-6 py-3 rounded-l-lg">Name</th>
                            <th class="px-6 py-3">Slug</th>
                            <th class="px-6 py-3 text-center rounded-r-lg">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @forelse($tags as $tag)
                            <tr class="hover:bg-gray-800/50 transition">
                                <td class="px-6 py-4 font-medium text-white">{{ $tag->name }}</td>
                                <td class="px-6 py-4">{{ $tag->slug }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.tags.edit', $tag) }}" class="text-blue-400 hover:text-blue-300">Edit</a>
                                        <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tag?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">No tags found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $tags->links() }}
            </div>
        </div>
    </div>
</x-dashboard-layout>
