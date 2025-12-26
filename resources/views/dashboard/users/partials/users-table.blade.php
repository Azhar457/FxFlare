<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="text-sm text-gray-400 border-b border-gray-800">
                <th class="py-3 px-4">Name</th>
                <th class="py-3 px-4">Email</th>
                <th class="py-3 px-4">Role</th>
                <th class="py-3 px-4">Created At</th>
                <th class="py-3 px-4 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="border-b border-gray-800 hover:bg-gray-800/50 transition" 
                x-show="!search || $el.querySelector('.js-name').textContent.toLowerCase().includes(search.toLowerCase()) || $el.querySelector('.js-email').textContent.toLowerCase().includes(search.toLowerCase())">
                <td class="py-3 px-4 font-medium text-white js-name">{{ $user->name }}</td>
                <td class="py-3 px-4 text-gray-400 js-email">{{ $user->email }}</td>
                <td class="py-3 px-4">
                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded bg-gray-800 text-gray-300 border border-gray-700">
                        {{ $user->role->name ?? 'User' }}
                    </span>
                </td>
                <td class="py-3 px-4 text-gray-500 text-sm">{{ $user->created_at->format('M d, Y') }}</td>
                <td class="py-3 px-4 text-right space-x-2">
                    <a href="{{ route('admin.users.edit', $user) }}" class="text-accent hover:text-white transition text-sm">Edit</a>
                    @if(auth()->id() !== $user->id)
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-400 transition text-sm">Delete</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
