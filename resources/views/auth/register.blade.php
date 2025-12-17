<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register | FXFLARE</title>

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
<body class="bg-darkbg min-h-screen flex items-center justify-center font-sans">

    <div class="bg-darkcard w-full max-w-md p-8 rounded-xl shadow-lg border border-gray-800">

        <div class="mb-6 text-center">
            <h1 class="text-3xl font-bold text-white tracking-wide">
                FXFLARE
            </h1>
            <p class="text-sm text-silver mt-2">
                Illuminating Global Markets with Intelligence
            </p>
        </div>

        <form action="/register" method="POST" class="space-y-5">

            <div>
                <label class="block text-sm text-silver mb-1">
                    Name
                </label>
                <input
                    type="text"
                    name="name"
                    placeholder="Your Full Name"
                    class="w-full px-4 py-2 rounded-md bg-darkbg text-white border border-gray-700
                           focus:outline-none focus:border-accent"
                    required
                >
            </div>

            <div>
                <label class="block text-sm text-silver mb-1">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    placeholder="email@example.com"
                    class="w-full px-4 py-2 rounded-md bg-darkbg text-white border border-gray-700
                           focus:outline-none focus:border-accent"
                    required
                >
            </div>

            <div>
                <label class="block text-sm text-silver mb-1">
                    Password
                </label>
                <input
                    type="password"
                    name="password"
                    placeholder="********"
                    class="w-full px-4 py-2 rounded-md bg-darkbg text-white border border-gray-700
                           focus:outline-none focus:border-accent"
                    required
                >
            </div>

            <div>
                <label class="block text-sm text-silver mb-1">
                    Confirm Password
                </label>
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="********"
                    class="w-full px-4 py-2 rounded-md bg-darkbg text-white border border-gray-700
                           focus:outline-none focus:border-accent"
                    required
                >
            </div>

            <button
                type="submit"
                class="w-full py-2 rounded-md bg-accent text-black font-semibold
                       hover:opacity-90 transition"
            >
                Sign Up
            </button>

            <div class="text-center text-sm text-silver">
                Already have an account?
                <a href="/login" class="text-accent font-semibold hover:underline">
                    Sign In
                </a>
            </div>

        </form>

        <div class="mt-6 text-center text-xs text-silver">
            Powered by FXFLARE
        </div>

    </div>

</body>
</html>