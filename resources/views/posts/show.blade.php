<x-dashboard-layout>
    <x-slot:title>
        {{ $post->title }} | FXFLARE
    </x-slot:title>

    <div class="max-w-4xl mx-auto px-6 py-12">
        <div class="mb-8">
            <a href="{{ route('admin.posts.index') }}" class="text-gray-400 hover:text-white transition flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Posts
            </a>
            <div class="flex justify-between items-start">
                <h1 class="text-3xl font-bold text-white">{{ $post->title }}</h1>
                <div class="flex gap-2">
                    <a href="{{ route('admin.posts.edit', $post) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Edit</a>
                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this post?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Delete</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-darkcard border border-gray-800 rounded-xl p-8 overflow-hidden">
            @if($post->thumbnail)
                <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover rounded-lg mb-6">
            @endif

            <div class="flex items-center gap-4 text-sm text-gray-400 mb-6 border-b border-gray-800 pb-4">
                <span class="bg-accent/10 text-accent px-2 py-1 rounded">{{ $post->category->name }}</span>
                <span>By {{ $post->user->name }}</span>
                <span>{{ $post->created_at->format('M d, Y') }}</span>
                <span class="{{ $post->status === 'published' ? 'text-green-400' : 'text-yellow-400' }} uppercase text-xs font-bold border border-current px-2 py-0.5 rounded">
                    {{ $post->status }}
                </span>
            </div>

            <div class="prose prose-invert max-w-none">
                {!! nl2br(e($post->content)) !!}
            </div>

            <div class="mt-8 pt-6 border-t border-gray-800">
                <h3 class="text-lg font-bold text-white mb-2">Tags</h3>
                <div class="flex flex-wrap gap-2">
                    @forelse($post->tags as $tag)
                        <span class="bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-sm">#{{ $tag->name }}</span>
                    @empty
                        <span class="text-gray-500 italic">No tags</span>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
