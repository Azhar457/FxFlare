<x-dashboard-layout>
    <x-slot:title>
        Create Post | FXFLARE
    </x-slot:title>

    <div class="max-w-4xl mx-auto px-6 py-12">
        <div class="mb-8">
            <a href="{{ route('admin.posts.index') }}" class="text-gray-400 hover:text-white transition flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Posts
            </a>
            <h1 class="text-3xl font-bold text-white">Create New Post</h1>
        </div>

        <div class="bg-darkcard border border-gray-800 rounded-xl p-8">
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-400 mb-2">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="w-full bg-darkbg border border-gray-700 text-white rounded-lg px-4 py-3 focus:outline-none focus:border-accent transition placeholder-gray-500">
                    @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-400 mb-2">Category</label>
                    <select name="category_id" id="category_id" required
                        class="w-full bg-darkbg border border-gray-700 text-white rounded-lg px-4 py-3 focus:outline-none focus:border-accent transition">
                        <option value="">Select Category...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Tags (Multi-Select) -->
                <div x-data="{
                    open: false,
                    search: '',
                    selected: {{ json_encode(collect(old('tags', []))->map(fn($i) => (int)$i)->values()) }},
                    items: {{ json_encode($tags->map(fn($t) => ['id' => $t->id, 'name' => $t->name])) }},
                    get filteredItems() {
                         return this.items.filter(i => 
                            i.name.toLowerCase().includes(this.search.toLowerCase()) && 
                            !this.selected.includes(i.id)
                        );
                    },
                    get selectedItems() {
                        return this.items.filter(i => this.selected.includes(i.id));
                    },
                    add(id) {
                        if (!this.selected.includes(id)) {
                            this.selected.push(id);
                            this.search = '';
                            this.open = false; 
                        }
                    },
                    remove(id) {
                        this.selected = this.selected.filter(i => i !== id);
                    }
                }" class="relative">
                    <label class="block text-sm font-medium text-gray-400 mb-2">Tags</label>
                    
                    <!-- Hidden Valid Select for Form Submission (Dynamic) -->
                    <template x-for="id in selected" :key="id">
                        <input type="hidden" name="tags[]" :value="id">
                    </template>

                    <!-- Custom Input Area -->
                    <div @click="open = true; $nextTick(() => $refs.searchInput.focus())" @click.away="open = false"
                         class="w-full bg-darkbg border border-gray-700 rounded-lg px-4 py-3 min-h-[50px] flex flex-wrap gap-2 items-center cursor-text focus-within:border-accent transition">
                        
                        <!-- Selected Pills -->
                        <template x-for="item in selectedItems" :key="item.id">
                            <span class="bg-accent/20 text-accent border border-accent/50 rounded-full px-3 py-1 text-sm flex items-center gap-1">
                                <span x-text="item.name"></span>
                                <button type="button" @click.stop="remove(item.id)" class="hover:text-white transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </span>
                        </template>

                        <!-- Search Input -->
                        <input x-ref="searchInput" x-model="search" 
                               @keydown.escape="open = false"
                               @keydown.enter.prevent="if(filteredItems.length > 0) add(filteredItems[0].id)"
                               placeholder="Select tags..." 
                               class="bg-transparent border-none text-white focus:ring-0 p-0 text-sm flex-grow min-w-[100px] placeholder-gray-500">
                    </div>

                    <!-- Dropdown -->
                    <div x-show="open && filteredItems.length > 0" 
                         x-transition.origin.top
                         class="absolute z-10 w-full bg-darkcard border border-gray-700 rounded-lg mt-1 shadow-xl max-h-60 overflow-y-auto">
                        <template x-for="item in filteredItems" :key="item.id">
                            <div @click="add(item.id)" 
                                 class="px-4 py-2 hover:bg-gray-700 cursor-pointer text-gray-300 hover:text-white transition">
                                <span x-text="item.name"></span>
                            </div>
                        </template>
                    </div>
                    
                    <!-- No Results -->
                    <div x-show="open && filteredItems.length === 0" class="absolute z-10 w-full bg-darkcard border border-gray-700 rounded-lg mt-1 shadow-xl p-4 text-gray-500 text-center text-sm">
                        No tags found.
                    </div>

                    @error('tags') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-400 mb-2">Content</label>
                    <textarea name="content" id="content" rows="10" required
                        class="w-full bg-darkbg border border-gray-700 text-white rounded-lg px-4 py-3 focus:outline-none focus:border-accent transition placeholder-gray-500">{{ old('content') }}</textarea>
                    @error('content') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Image -->
                <div>
                    <label for="thumbnail" class="block text-sm font-medium text-gray-400 mb-2">Thumbnail Image</label>
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                        class="w-full bg-darkbg border border-gray-700 text-white rounded-lg px-4 py-3 focus:outline-none focus:border-accent transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-accent file:text-white hover:file:bg-accent-hover">
                    @error('thumbnail') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-400 mb-2">Status</label>
                    <select name="status" id="status" required
                        class="w-full bg-darkbg border border-gray-700 text-white rounded-lg px-4 py-3 focus:outline-none focus:border-accent transition">
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Submit -->
                <div class="pt-4 flex justify-end">
                    <button type="submit" class="px-8 py-3 bg-accent text-white font-bold rounded-lg hover:bg-accent-hover transition transform hover:scale-105">
                        Create Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>
