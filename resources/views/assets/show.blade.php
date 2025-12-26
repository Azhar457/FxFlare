<x-layout>
    <x-slot:title>
        {{ $asset->name }} ({{ $asset->symbol }}) | FXFLARE
    </x-slot:title>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('watchlist.index') }}" class="text-gray-400 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ $asset->name }}</h1>
                    <p class="text-gray-400">{{ $asset->symbol }}</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-3xl font-bold text-white">${{ number_format($asset->price, 5) }}</p>
                <p class="text-lg {{ $asset->change_24h >= 0 ? 'text-green-500' : 'text-red-500' }} flex items-center justify-end gap-1">
                    {{ $asset->change_24h >= 0 ? '+' : '' }}{{ $asset->change_24h }}%
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Chart Area -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Mock Chart -->
                <div class="bg-darkcard border border-gray-800 rounded-xl p-6 h-96 relative overflow-hidden flex items-end gap-2">
                    @foreach($chartData as $point)
                        <div class="w-full bg-accent/20 hover:bg-accent/40 transition-all rounded-t" style="height: {{ ($point / max($chartData)) * 100 }}%"></div>
                    @endforeach
                    <div class="absolute top-4 left-4 text-xs text-gray-500">MOCK CHART DATA</div>
                </div>

                <!-- About Asset -->
                <div class="bg-darkcard border border-gray-800 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-white mb-4">About {{ $asset->name }}</h3>
                    <p class="text-gray-400">
                        {{ $asset->name }} ({{ $asset->symbol }}) is a major trading asset. This section would contain details about market cap, volume, and other fundamental analysis data.
                    </p>
                </div>
            </div>

            <!-- Sidebar: Alerts & Actions -->
            <div class="space-y-6">
                <!-- Set Price Alert -->
                <div class="bg-darkcard border border-gray-800 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-white mb-4">Set Price Alert</h3>
                    <form action="{{ route('price-alerts.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="asset_id" value="{{ $asset->id }}">
                        
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Target Price</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2.5 text-gray-400">$</span>
                                <input type="number" step="0.00001" name="target_price" class="w-full bg-darkbg border border-gray-700 rounded-lg pl-8 pr-3 py-2 text-white focus:outline-none focus:border-accent" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Condition</label>
                            <select name="condition" class="w-full bg-darkbg border border-gray-700 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-accent">
                                <option value="above">Alert when price goes ABOVE</option>
                                <option value="below">Alert when price goes BELOW</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full bg-accent hover:bg-accent/80 text-white font-bold py-2 rounded-lg transition">
                            Create Alert
                        </button>
                    </form>
                </div>

                <!-- Active Alerts -->
                <div class="bg-darkcard border border-gray-800 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-white mb-4">Your Active Alerts</h3>
                    @if($alerts->count() > 0)
                        <div class="space-y-3">
                            @foreach($alerts as $alert)
                                <div class="bg-darkbg/50 border border-gray-700 rounded-lg p-3 flex justify-between items-center">
                                    <div>
                                        <p class="text-white text-sm font-medium">Target: ${{ number_format($alert->target_price, 5) }}</p>
                                        <p class="text-gray-400 text-xs uppercase">{{ $alert->condition }}</p>
                                    </div>
                                    <form action="{{ route('price-alerts.destroy', $alert) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-500 hover:text-red-500 p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm text-center py-4">No active alerts for this asset.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>
