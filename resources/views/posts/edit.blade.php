<x-layout>
    <x-slot:title>
        Edit: {{ $post->title }} | FXFLARE
    </x-slot:title>

    <div class="max-w-4xl mx-auto px-6 py-12">
        <div class="mb-8">
            <a href="{{ route('admin.posts.index') }}" class="text-gray-400 hover:text-white transition flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Posts
            </a>
            <h1 class="text-3xl font-bold text-white">Edit Post</h1>
        </div>

        <div class="bg-darkcard border border-gray-800 rounded-xl p-8">
            <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-400 mb-2">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required
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
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Tags -->
                <div>
                    <label for="tags" class="block text-sm font-medium text-gray-400 mb-2">Tags</label>
                    <select name="tags[]" id="tags" multiple
                        class="w-full bg-darkbg border border-gray-700 text-white rounded-lg px-4 py-3 focus:outline-none focus:border-accent transition h-32">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" {{ (collect(old('tags', $post->tags->pluck('id')->toArray()))->contains($tag->id)) ? 'selected' : '' }}>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    @error('tags') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-400 mb-2">Content</label>
                    <textarea name="content" id="content" rows="10" required
                        class="w-full bg-darkbg border border-gray-700 text-white rounded-lg px-4 py-3 focus:outline-none focus:border-accent transition placeholder-gray-500">{{ old('content', $post->content) }}</textarea>
                    @error('content') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Image -->
                <div>
                    <label for="thumbnail" class="block text-sm font-medium text-gray-400 mb-2">Thumbnail Image</label>
                    @if($post->thumbnail)
                        <div class="mb-2">
                            <img src="{{ Storage::url($post->thumbnail) }}" alt="Current Image" class="h-32 rounded">
                        </div>
                    @endif
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                        class="w-full bg-darkbg border border-gray-700 text-white rounded-lg px-4 py-3 focus:outline-none focus:border-accent transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-accent file:text-white hover:file:bg-accent-hover">
                    <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image.</p>
                    @error('thumbnail') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-400 mb-2">Status</label>
                    <select name="status" id="status" required
                        class="w-full bg-darkbg border border-gray-700 text-white rounded-lg px-4 py-3 focus:outline-none focus:border-accent transition">
                        <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Submit -->
                <div class="pt-4 flex justify-end">
                    <button type="submit" class="px-8 py-3 bg-accent text-white font-bold rounded-lg hover:bg-accent-hover transition transform hover:scale-105">
                        Update Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
