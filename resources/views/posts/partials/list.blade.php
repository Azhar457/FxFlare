@foreach($posts as $post)
    <tr class="border-b border-gray-700 hover:bg-gray-700/50 transition">
        <td class="px-6 py-4 text-white">
            {{ $posts->firstItem() + $loop->index }}
        </td>
        <td class="px-6 py-4">
            <div class="flex items-center gap-3">
                @if($post->thumbnail)
                    <img src="{{ Storage::url($post->thumbnail) }}" alt="Thumbnail" class="w-10 h-10 rounded object-cover">
                @else
                    <div class="w-10 h-10 rounded bg-gray-600 flex items-center justify-center text-xs text-white">
                        No Img
                    </div>
                @endif
                <span class="text-white font-medium">{{ $post->title }}</span>
            </div>
        </td>
        <td class="px-6 py-4 text-gray-300">
            {{ $post->category->name }}
        </td>
        <td class="px-6 py-4 text-gray-300">
            {{ $post->user->name }}
        </td>
        <td class="px-6 py-4">
            <span class="px-2 py-1 text-xs rounded font-bold uppercase {{ $post->status === 'published' ? 'bg-green-500/10 text-green-500' : 'bg-yellow-500/10 text-yellow-500' }}">
                {{ $post->status }}
            </span>
        </td>
        <td class="px-6 py-4 text-gray-400 text-sm">
            {{ $post->created_at->format('M d, Y') }}
        </td>
        <td class="px-6 py-4 text-right">
            <div class="flex items-center justify-end gap-2">
                <a href="{{ route('admin.posts.edit', $post) }}" class="p-2 text-blue-400 hover:bg-blue-400/10 rounded transition" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </a>
                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 text-red-400 hover:bg-red-400/10 rounded transition" title="Delete">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </form>
            </div>
        </td>
    </tr>
@endforeach
<tr id="pagination-row">
    <td colspan="7" class="px-6 py-4">
        {{ $posts->links() }}
    </td>
</tr>
