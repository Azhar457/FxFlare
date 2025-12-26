<x-layout>
    <x-slot:title>
        My Watchlist | FXFLARE
    </x-slot:title>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">My Watchlist</h1>
                <p class="text-gray-400">Monitor your favorite market assets.</p>
            </div>
            
            <!-- Controls -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 w-full md:w-auto">
                <form action="{{ route('watchlist.index') }}" method="GET" class="flex flex-1 sm:flex-none items-center gap-2 w-full sm:w-auto">
                    <div class="relative w-full sm:w-48">
                        <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}" class="w-full bg-darkbg border border-gray-700 rounded-lg pl-3 pr-8 py-2 text-white text-sm focus:outline-none focus:border-accent transition">
                        <button type="submit" class="absolute right-2 top-2 text-gray-500 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                    <select name="sort" onchange="this.form.submit()" class="bg-darkbg border border-gray-700 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:border-accent transition cursor-pointer">
                        <option value="symbol" {{ request('sort') == 'symbol' ? 'selected' : '' }}>Symbol</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price &darr;</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price &uarr;</option>
                        <option value="change_desc" {{ request('sort') == 'change_desc' ? 'selected' : '' }}>Change &darr;</option>
                        <option value="change_asc" {{ request('sort') == 'change_asc' ? 'selected' : '' }}>Change &uarr;</option>
                    </select>
                </form>

                <!-- Add Asset -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="bg-accent hover:bg-accent/80 text-white font-bold p-2 rounded-lg transition duration-200 flex items-center justify-center" title="Add New Asset">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </button>

                    <div x-show="open" 
                         @click.away="open = false" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-72 bg-darkcard border border-gray-800 rounded-xl shadow-2xl z-50 p-4">
                        <h3 class="text-white font-bold mb-3 text-sm">Add to Watchlist</h3>
                        <form action="{{ route('watchlist.store') }}" method="POST">
                            @csrf
                            <select name="asset_id" class="w-full bg-darkbg border border-gray-700 rounded-lg px-3 py-2 text-white mb-4 text-sm focus:outline-none focus:border-accent">
                                @foreach($allAssets as $asset)
                                    <option value="{{ $asset->id }}">{{ $asset->symbol }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="w-full bg-accent hover:bg-accent/80 text-white font-bold py-2 rounded-lg text-sm transition">
                                Add
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if($watchlist->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($watchlist as $asset)
                    <div class="bg-darkcard border border-gray-800 rounded-xl p-5 hover:border-accent/50 transition duration-300 group relative shadow-lg hover:shadow-accent/5">
                        <a href="{{ route('assets.show', $asset->symbol) }}" class="block">
                            <div class="flex justify-between items-start mb-3">
                                <div class="truncate pr-2">
                                    <h3 class="text-xl font-bold text-white leading-tight">{{ $asset->symbol }}</h3>
                                    <p class="text-xs text-gray-500 truncate">{{ $asset->name }}</p>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="text-lg font-bold text-white tracking-wide">${{ number_format($asset->price, 2) }}</p>
                                    <p class="text-xs font-medium {{ $asset->change_24h >= 0 ? 'text-green-500' : 'text-red-500' }} flex items-center justify-end gap-1">
                                        {{ $asset->change_24h >= 0 ? '+' : '' }}{{ $asset->change_24h }}%
                                    </p>
                                </div>
                            </div>
                        </a>

                        <!-- Remove Button -->
                        <form action="{{ route('watchlist.destroy', $asset) }}" method="POST" class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-600 hover:text-red-500 p-1.5 rounded-full hover:bg-gray-800 transition" title="Remove">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </form>

                        <!-- Mini Chart -->
                        <div class="h-12 mt-3 flex items-end gap-0.5 opacity-60">
                            @for($i = 0; $i < 20; $i++)
                                <div class="w-full bg-{{ $asset->change_24h >= 0 ? 'green' : 'red' }}-500/30 rounded-t-[1px]" style="height: {{ rand(15, 100) }}%"></div>
                            @endfor
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-darkcard border border-gray-800 rounded-xl p-12 text-center max-w-lg mx-auto mt-12">
                <div class="w-16 h-16 bg-gray-800/50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Your watchlist is empty</h3>
                <p class="text-gray-400 text-sm mb-6">Start tracking your favorite assets for real-time updates.</p>
                <div x-data="{ open: false }" class="relative inline-block">
                    <button @click="open = !open" class="bg-accent hover:bg-accent/80 text-white font-bold py-2 px-6 rounded-lg transition">
                        Add Asset
                    </button>
                    <!-- Dropdown for Empty State -->
                     <div x-show="open" 
                         @click.away="open = false" 
                         class="absolute left-1/2 -translate-x-1/2 mt-2 w-64 bg-darkcard border border-gray-800 rounded-xl shadow-xl z-50 p-4 text-left">
                        <form action="{{ route('watchlist.store') }}" method="POST">
                            @csrf
                            <select name="asset_id" class="w-full bg-darkbg border border-gray-700 rounded-lg px-3 py-2 text-white mb-4 text-sm focus:outline-none focus:border-accent">
                                @foreach($allAssets as $asset)
                                    <option value="{{ $asset->id }}">{{ $asset->symbol }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="w-full bg-accent hover:bg-accent/80 text-white font-bold py-2 rounded-lg text-sm transition">
                                Add
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-layout>
