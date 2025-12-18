{{-- @props(['items' => []])

<div class="w-full bg-darkcard border-y border-gray-800 overflow-hidden py-3">
    <div class="relative w-full flex">
        <div class="animate-marquee flex whitespace-nowrap min-w-full items-center">
            @if(empty($items))
                <!-- Default Placeholder Content -->
                <div class="flex items-center gap-8 px-4 text-sm font-medium">
                    <span class="text-gray-400">EUR/USD <span class="text-green-500">+0.24%</span> 1.0924</span>
                    <span class="text-gray-400">BTC/USD <span class="text-green-500">+0.57%</span> 42,156.23</span>
                    <span class="text-gray-400">SPX <span class="text-green-500">+0.68%</span> 4,567.89</span>
                    <span class="text-gray-400">Gold <span class="text-red-500">-0.74%</span> 2,034.50</span>
                    <span class="text-gray-400">USD/JPY <span class="text-red-500">-0.33%</span> 143.25</span>
                    <span class="text-gray-400">NASDAQ <span class="text-green-500">+0.92%</span> 15,678.34</span>
                </div>
                <!-- Duplicate for seamless loop -->
                <div class="flex items-center gap-8 px-4 text-sm font-medium">
                    <span class="text-gray-400">EUR/USD <span class="text-green-500">+0.24%</span> 1.0924</span>
                    <span class="text-gray-400">BTC/USD <span class="text-green-500">+0.57%</span> 42,156.23</span>
                    <span class="text-gray-400">SPX <span class="text-green-500">+0.68%</span> 4,567.89</span>
                    <span class="text-gray-400">Gold <span class="text-red-500">-0.74%</span> 2,034.50</span>
                    <span class="text-gray-400">USD/JPY <span class="text-red-500">-0.33%</span> 143.25</span>
                    <span class="text-gray-400">NASDAQ <span class="text-green-500">+0.92%</span> 15,678.34</span>
                </div>
            @else
                <!-- Dynamic Content implementation would go here -->
                {{ $slot }}
            @endif
        </div>
        <div class="absolute top-0 animate-marquee2 flex whitespace-nowrap min-w-full items-center">
            <!-- Second duplicate for absolute smooth infinite scroll (traditional CSS method) -->
            @if(empty($items))
                <div class="flex items-center gap-8 px-4 text-sm font-medium">
                    <span class="text-gray-400">EUR/USD <span class="text-green-500">+0.24%</span> 1.0924</span>
                    <span class="text-gray-400">BTC/USD <span class="text-green-500">+0.57%</span> 42,156.23</span>
                    <span class="text-gray-400">SPX <span class="text-green-500">+0.68%</span> 4,567.89</span>
                    <span class="text-gray-400">Gold <span class="text-red-500">-0.74%</span> 2,034.50</span>
                    <span class="text-gray-400">USD/JPY <span class="text-red-500">-0.33%</span> 143.25</span>
                    <span class="text-gray-400">NASDAQ <span class="text-green-500">+0.92%</span> 15,678.34</span>
                </div>
                <div class="flex items-center gap-8 px-4 text-sm font-medium">
                    <span class="text-gray-400">EUR/USD <span class="text-green-500">+0.24%</span> 1.0924</span>
                    <span class="text-gray-400">BTC/USD <span class="text-green-500">+0.57%</span> 42,156.23</span>
                    <span class="text-gray-400">SPX <span class="text-green-500">+0.68%</span> 4,567.89</span>
                    <span class="text-gray-400">Gold <span class="text-red-500">-0.74%</span> 2,034.50</span>
                    <span class="text-gray-400">USD/JPY <span class="text-red-500">-0.33%</span> 143.25</span>
                    <span class="text-gray-400">NASDAQ <span class="text-green-500">+0.92%</span> 15,678.34</span>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .animate-marquee {
        animation: marquee 25s linear infinite;
    }

    .animate-marquee2 {
        animation: marquee2 25s linear infinite;
    }

    @keyframes marquee {
        0% {
            transform: translateX(0%);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    @keyframes marquee2 {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(0%);
        }
    }
</style> --}}

@props(['items' => []])

<div class="w-full bg-darkcard border-y border-gray-800 overflow-hidden py-3">
    <div class="flex w-max">
        <div class="animate-marquee-smooth flex items-center">
            
            <div class="flex items-center gap-8 px-4 text-sm font-medium whitespace-nowrap">
                <span class="text-gray-400">EUR/USD <span class="text-green-500">+0.24%</span> 1.0924</span>
                <span class="text-gray-400">BTC/USD <span class="text-green-500">+0.57%</span> 42,156.23</span>
                <span class="text-gray-400">SPX <span class="text-green-500">+0.68%</span> 4,567.89</span>
                <span class="text-gray-400">Gold <span class="text-red-500">-0.74%</span> 2,034.50</span>
                <span class="text-gray-400">USD/JPY <span class="text-red-500">-0.33%</span> 143.25</span>
                <span class="text-gray-400">NASDAQ <span class="text-green-500">+0.92%</span> 15,678.34</span>
            </div>

            <div class="flex items-center gap-8 px-4 text-sm font-medium whitespace-nowrap">
                <span class="text-gray-400">EUR/USD <span class="text-green-500">+0.24%</span> 1.0924</span>
                <span class="text-gray-400">BTC/USD <span class="text-green-500">+0.57%</span> 42,156.23</span>
                <span class="text-gray-400">SPX <span class="text-green-500">+0.68%</span> 4,567.89</span>
                <span class="text-gray-400">Gold <span class="text-red-500">-0.74%</span> 2,034.50</span>
                <span class="text-gray-400">USD/JPY <span class="text-red-500">-0.33%</span> 143.25</span>
                <span class="text-gray-400">NASDAQ <span class="text-green-500">+0.92%</span> 15,678.34</span>
            </div>

        </div>
    </div>
</div>

<style>
    /* Pakai satu animasi saja */
    .animate-marquee-smooth {
        display: flex;
        /* Gunakan durasi yang konsisten */
        animation: marquee-infinite 25s linear infinite;
    }

    @keyframes marquee-infinite {
        0% {
            transform: translateX(0);
        }
        100% {
            /* PENTING: Geser tepat -50% karena kita punya 2 group data */
            transform: translateX(-50%);
        }
    }

    /* Berhenti saat hover agar user bisa baca */
    .animate-marquee-smooth:hover {
        animation-play-state: paused;
    }
</style>

