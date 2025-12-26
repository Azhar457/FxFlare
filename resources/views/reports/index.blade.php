<x-layout>
    <x-slot:title>
        Market Report | FXFLARE
    </x-slot:title>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-white">Market Intelligence Report</h1>
            <a href="{{ route('reports.pdf') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full transition duration-300 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                Download PDF
            </a>
        </div>

        @if(empty($coins))
            <div class="bg-red-500/20 border border-red-500 text-red-100 p-4 rounded-xl">
                Unable to fetch market data at this time. Please try again later.
            </div>
        @else
            <div class="overflow-x-auto bg-gray-800/50 rounded-2xl border border-gray-700/50">
                <table class="w-full text-left text-gray-300">
                    <thead class="bg-gray-800 text-gray-100 uppercase text-sm font-bold">
                        <tr>
                            <th class="px-6 py-4">Asset</th>
                            <th class="px-6 py-4 text-right">Price (USD)</th>
                            <th class="px-6 py-4 text-right">24h Change</th>
                            <th class="px-6 py-4 text-right">Market Cap</th>
                            <th class="px-6 py-4 text-right">Volume (24h)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/50 text-sm">
                        @foreach($coins as $coin)
                            <tr class="hover:bg-gray-700/30 transition">
                                <td class="px-6 py-4 flex items-center gap-3">
                                    <img src="{{ $coin['image'] }}" alt="{{ $coin['name'] }}" class="w-8 h-8 rounded-full">
                                    <span class="font-bold text-white">{{ $coin['name'] }}</span>
                                    <span class="text-gray-500 uppercase text-xs">{{ $coin['symbol'] }}</span>
                                </td>
                                <td class="px-6 py-4 text-right font-mono text-white">
                                    ${{ number_format($coin['current_price'], 2) }}
                                </td>
                                <td class="px-6 py-4 text-right font-bold w-32 {{ $coin['price_change_percentage_24h'] >= 0 ? 'text-green-500' : 'text-red-500' }}">
                                    {{ number_format($coin['price_change_percentage_24h'], 2) }}%
                                </td>
                                <td class="px-6 py-4 text-right text-gray-400">
                                    ${{ number_format($coin['market_cap']) }}
                                </td>
                                <td class="px-6 py-4 text-right text-gray-400">
                                    ${{ number_format($coin['total_volume']) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-layout>
