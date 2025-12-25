@props(['comment'])

<div class="flex gap-4 comment-item" id="comment-{{ $comment->id }}">
    <div class="flex-shrink-0">
        <div class="w-10 h-10 rounded-full bg-gray-800 border border-gray-700 flex items-center justify-center text-gray-400 font-bold">
            {{ substr($comment->user->name, 0, 1) }}
        </div>
    </div>
    <div class="flex-grow">
        <div class="bg-darkcard border border-gray-800 rounded-xl p-4">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <h5 class="font-bold text-white text-sm">{{ $comment->user->name }}</h5>
                    <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                
                @if(auth()->id() === $comment->user_id || (auth()->user() && auth()->user()->role->name === 'admin'))
                    <button @click="deleteComment({{ $comment->id }}, '{{ route('comments.destroy', $comment) }}')" class="text-gray-500 hover:text-red-500 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                @endif
            </div>
            <p class="text-gray-300 text-sm whitespace-pre-line">{{ $comment->body }}</p>
        </div>
    </div>
</div>
