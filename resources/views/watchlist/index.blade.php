<x-layout>
    <x-slot:title>
        My Watchlist | FXFLARE
    </x-slot:title>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">My Watchlist</h1>
                <p class="text-gray-400">Monitor your favorite market assets in real-time.</p>
            </div>
            
            <!-- Search and Sort Controls -->
            <div class="flex items-center gap-4">
                <form action="{{ route('watchlist.index') }}" method="GET" class="flex items-center gap-2">
                    <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}" class="bg-darkbg border border-gray-700 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:border-accent">
                    <select name="sort" onchange="this.form.submit()" class="bg-darkbg border border-gray-700 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:border-accent">
                        <option value="symbol" {{ request('sort') == 'symbol' ? 'selected' : '' }}>Symbol (A-Z)</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price (High-Low)</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price (Low-High)</option>
                        <option value="change_desc" {{ request('sort') == 'change_desc' ? 'selected' : '' }}>Change (High-Low)</option>
                        <option value="change_asc" {{ request('sort') == 'change_asc' ? 'selected' : '' }}>Change (Low-High)</option>
                    </select>
                </form>

                <!-- Simple Add Asset Form (Dropdown) -->
                <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="bg-accent hover:bg-accent/80 text-white font-bold py-2 px-4 rounded-lg transition duration-200 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Asset
                </button>

                <div x-show="open" 
                     @click.away="open = false" 
                     class="absolute right-0 mt-2 w-72 bg-darkcard border border-gray-800 rounded-xl shadow-xl z-50 p-4">
                    <h3 class="text-white font-bold mb-3">Add to Watchlist</h3>
                    <form action="{{ route('watchlist.store') }}" method="POST">
                        @csrf
                        <select name="asset_id" class="w-full bg-darkbg border border-gray-700 rounded-lg px-3 py-2 text-white mb-4 focus:outline-none focus:border-accent">
                            @foreach($allAssets as $asset)
                                <option value="{{ $asset->id }}">{{ $asset->symbol }} - {{ $asset->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="w-full bg-accent hover:bg-accent/80 text-white font-bold py-2 rounded-lg transition">
                            Add Selected
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @if($watchlist->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($watchlist as $asset)
                    <div class="bg-darkcard border border-gray-800 rounded-xl p-6 hover:border-gray-700 transition group relative">
                        <a href="{{ route('assets.show', $asset->symbol) }}" class="block">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-2xl font-bold text-white">{{ $asset->symbol }}</h3>
                                    <p class="text-sm text-gray-400">{{ $asset->name }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xl font-bold text-white">${{ number_format($asset->price, 2) }}</p>
                                    <p class="text-sm {{ $asset->change_24h >= 0 ? 'text-green-500' : 'text-red-500' }} flex items-center justify-end gap-1">
                                        {{ $asset->change_24h >= 0 ? '+' : '' }}{{ $asset->change_24h }}%
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $asset->change_24h >= 0 ? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' : 'M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6' }}" />
                                        </svg>
                                    </p>
                                </div>
                            </div>
                        </a>

                        <!-- Remove Button (Top Right Absolute) -->
                        <form action="{{ route('watchlist.destroy', $asset) }}" method="POST" class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-500 hover:text-red-500 p-1" title="Remove from Watchlist">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </form>

                        <!-- Mini Chart Placeholder -->
                        <div class="h-16 mt-4 flex items-end gap-1 opacity-50">
                            @for($i = 0; $i < 20; $i++)
                                <div class="w-full bg-{{ $asset->change_24h >= 0 ? 'green' : 'red' }}-500/20 rounded-t-sm" style="height: {{ rand(20, 100) }}%"></div>
                            @endfor
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-darkcard border border-gray-800 rounded-xl p-12 text-center">
                <div class="w-16 h-16 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Your watchlist is empty</h3>
                <p class="text-gray-400 max-w-md mx-auto mb-6">Start tracking your favorite assets by adding them to your watchlist. You'll see real-time updates here.</p>
                <button @click="open = true" x-data class="bg-accent hover:bg-accent/80 text-white font-bold py-2 px-6 rounded-lg transition">
                    Add Your First Asset
                </button>
            </div>
        @endif
    </div>
</x-layout>
