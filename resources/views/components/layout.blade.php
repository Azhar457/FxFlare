<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'FXFLARE' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        darkbg: '#121212',
                        darkcard: '#1E1E1E',
                        accent: '#BB86FC',
                        silver: '#B0B3B8'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-darkbg text-white font-sans">

    <!-- NAVBAR -->
    <nav class="border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <span class="text-xl font-bold tracking-wide text-accent">
                FXFLARE
            </span>

            <div class="space-x-6 text-sm text-silver">
                <a href="/" class="hover:text-white transition">Home</a>
                <a href="#" class="hover:text-white transition">Markets</a>
                <a href="#" class="hover:text-white transition">Crypto</a>
                <a href="#" class="hover:text-white transition">Stocks</a>
            </div>
        </div>
    </nav>

    <!-- SLOT CONTENT -->
    <main class="max-w-7xl mx-auto px-6 py-8">
        {{ $slot }}
    </main>

    <!-- FOOTER -->
    <footer class="border-t border-gray-800 py-6 text-center text-xs text-silver">
        © {{ date('Y') }} FXFLARE — Market Intelligence Powered by AI
    </footer>

</body>
</html>
