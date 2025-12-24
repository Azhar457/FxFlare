<x-layout>
    <x-slot:title>
        Create Category | FXFLARE
    </x-slot:title>

    <div class="max-w-2xl mx-auto px-6 py-12">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('admin.categories.index') }}" class="text-gray-400 hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-3xl font-bold text-white">Create New Category</h1>
        </div>

        <div class="bg-darkcard border border-gray-800 rounded-xl p-8 shadow-xl">
            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-400 mb-2">Category Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full bg-darkbg border border-gray-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent" required placeholder="e.g. Forex">
                    @error('name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-accent hover:bg-accent/80 text-white font-bold py-2 px-6 rounded-lg transition duration-200">
                        Create Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
