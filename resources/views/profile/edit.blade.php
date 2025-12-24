<x-layout>
    <x-slot:title>
        Edit Profile | FXFLARE
    </x-slot:title>

    <div class="max-w-2xl mx-auto px-6 py-12">
        <h1 class="text-3xl font-bold text-white mb-8">Edit Profile</h1>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-900/50 border border-green-800 text-green-200 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-darkcard border border-gray-800 rounded-xl p-8 shadow-xl">
            <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-400 mb-2">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full bg-darkbg border border-gray-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent" required>
                    @error('name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-400 mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full bg-darkbg border border-gray-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent" required>
                    @error('email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-400 mb-2">New Password (Optional)</label>
                    <input type="password" name="password" id="password" class="w-full bg-darkbg border border-gray-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent" placeholder="Leave blank to keep current password">
                    @error('password')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-400 mb-2">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full bg-darkbg border border-gray-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-accent focus:ring-1 focus:ring-accent">
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-accent hover:bg-accent/80 text-white font-bold py-2 px-6 rounded-lg transition duration-200">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
