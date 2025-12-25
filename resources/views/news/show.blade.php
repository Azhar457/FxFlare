<x-layout>
    <x-slot:title>
        {{ $post->title }} | FXFLARE
    </x-slot:title>

    <div class="max-w-4xl mx-auto px-6 py-12">
        <div class="mb-8">
            <a href="{{ route('news.index') }}" class="text-gray-400 hover:text-white transition flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to News
            </a>
            
            <div class="flex items-center gap-2 text-sm text-accent font-bold uppercase tracking-wider mb-3">
                @if($post->category)
                    <span>{{ $post->category->name }}</span>
                @endif
                <span class="text-gray-600">•</span>
                <span class="text-gray-400">{{ $post->published_at ? $post->published_at->format('M d, Y') : 'Draft' }}</span>
            </div>

            <h1 class="text-3xl md:text-5xl font-bold text-white mb-6 leading-tight">{{ $post->title }}</h1>

            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center text-white font-bold">
                    {{ substr($post->user->name ?? 'A', 0, 1) }}
                </div>
                <div>
                    <div class="text-white font-medium">{{ $post->user->name ?? 'admin' }}</div>
                    <div class="text-xs text-gray-500">Author</div>
                </div>
            </div>
        </div>

        @if($post->thumbnail)
            <div class="rounded-xl overflow-hidden mb-10 border border-gray-800">
                <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="w-full max-h-[500px] object-cover">
            </div>
        @endif

        <article class="prose prose-invert prose-lg max-w-none text-gray-300 mb-8">
            {!! nl2br(e($post->content)) !!}
        </article>

        <!-- Like Button -->
        <div class="flex items-center gap-4 mb-8" x-data="{ 
            liked: {{ $post->likes->contains('user_id', auth()->id()) ? 'true' : 'false' }},
            count: {{ $post->likes->count() }},
            loading: false,
            toggleLike() {
                if (this.loading) return;
                this.loading = true;
                fetch('{{ route('likes.toggle', $post) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(res => {
                    if (res.status === 401) {
                        window.location.href = '{{ route('login') }}';
                        return;
                    }
                    return res.json();
                })
                .then(data => {
                    if (data) {
                        this.liked = data.liked;
                        this.count = data.count;
                    }
                })
                .finally(() => this.loading = false);
            }
        }">
            <button @click="toggleLike()" 
                    class="flex items-center gap-2 px-4 py-2 rounded-full border transition duration-200"
                    :class="liked ? 'bg-red-500/10 border-red-500 text-red-500' : 'bg-gray-800 border-gray-700 text-gray-400 hover:text-white'">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" :fill="liked ? 'currentColor' : 'none'" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <span class="font-bold" x-text="count"></span>
                <span x-text="liked ? 'Liked' : 'Like'"></span>
            </button>
        </div>

        <div class="mt-12 pt-8 border-t border-gray-800">
            <h3 class="text-lg font-bold text-white mb-4">Tags</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($post->tags as $tag)
                    <a href="{{ route('news.index', ['tag' => $tag->slug]) }}" class="px-3 py-1 bg-darkcard border border-gray-700 rounded-full text-sm text-gray-400 hover:text-white hover:border-gray-500 transition">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Comments Section -->
        <div class="mt-12 pt-8 border-t border-gray-800" x-data="{ 
            count: {{ $post->comments->count() }},
            loading: false,
            body: '',
            commentsList: null,
            submitComment() {
                if (this.body.trim() === '') return;
                this.loading = true;
                
                fetch('{{ route('comments.store', $post) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ body: this.body })
                })
                .then(res => res.json())
                .then(data => {
                    this.body = '';
                    this.count = data.count;
                    // Append new comment HTML
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = data.html;
                    document.getElementById('comments-container').prepend(tempDiv.firstElementChild);
                    
                    window.dispatchEvent(new CustomEvent('notify', { 
                        detail: { 
                            type: 'success', 
                            title: 'Success', 
                            message: data.message 
                        } 
                    }));
                })
                .catch(err => {
                    console.error(err);
                    window.dispatchEvent(new CustomEvent('notify', { 
                        detail: { 
                            type: 'error', 
                            title: 'Error', 
                            message: 'Failed to post comment.' 
                        } 
                    }));
                })
                .finally(() => this.loading = false);
            },
            deleteComment(id, url) {
                if (!confirm('Delete this comment?')) return;
                
                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.count = data.count;
                    const el = document.getElementById('comment-' + id);
                    if (el) el.remove();
                    
                    window.dispatchEvent(new CustomEvent('notify', { 
                        detail: { 
                            type: 'success', 
                            title: 'Deleted', 
                            message: data.message 
                        } 
                    }));
                })
                .catch(err => {
                    console.error(err);
                     window.dispatchEvent(new CustomEvent('notify', { 
                        detail: { 
                            type: 'error', 
                            title: 'Error', 
                            message: 'Failed to delete comment.' 
                        } 
                    }));
                });
            }
        }">
            <h3 class="text-2xl font-bold text-white mb-6">Comments (<span x-text="count"></span>)</h3>
            
            <!-- Comment Form -->
            @auth
                <form @submit.prevent="submitComment()" class="mb-10">
                    <div class="mb-4">
                        <label for="body" class="sr-only">Leave a comment</label>
                        <textarea x-model="body" rows="3" 
                            class="w-full bg-darkcard border border-gray-700 rounded-xl p-4 text-white focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent placeholder-gray-500"
                            placeholder="Share your thoughts..." required></textarea>
                    </div>
                    <div class="flex justify-end items-center gap-4">
                        <!-- Skeleton Loader (visible when loading) -->
                        <div x-show="loading" class="flex gap-2 items-center text-gray-400 text-sm">
                            <svg class="animate-spin h-4 w-4 text-accent" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Posting...
                        </div>
                        
                        <button type="submit" :disabled="loading" class="bg-accent hover:bg-accent/80 text-white font-bold py-2 px-6 rounded-lg transition duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                            Post Comment
                        </button>
                    </div>
                </form>
            @else
                <div class="bg-gray-800/50 rounded-xl p-6 mb-10 text-center border border-gray-700">
                    <p class="text-gray-400 mb-4">Please log in to join the discussion.</p>
                    <a href="{{ route('login') }}" class="inline-block bg-gray-700 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition">
                        Log In
                    </a>
                </div>
            @endauth

            <!-- Comments List -->
            <div id="comments-container" class="space-y-6">
                 <!-- Skeleton for new comment (optional, but requested) -->
                 <div x-show="loading" class="flex gap-4 animate-pulse">
                     <div class="flex-shrink-0">
                         <div class="w-10 h-10 rounded-full bg-gray-700"></div>
                     </div>
                     <div class="flex-grow">
                         <div class="bg-darkcard border border-gray-800 rounded-xl p-4 space-y-3">
                             <div class="h-4 bg-gray-700 rounded w-1/4"></div>
                             <div class="h-3 bg-gray-700 rounded w-full"></div>
                             <div class="h-3 bg-gray-700 rounded w-2/3"></div>
                         </div>
                     </div>
                 </div>

                @forelse($post->comments as $comment)
                    @include('news.partials.comment-item', ['comment' => $comment])
                @empty
                    <p class="text-gray-500 italic" x-show="count == 0 && !loading">No comments yet. Be the first to share your thoughts!</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layout>
