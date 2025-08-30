@extends('layouts.app')

@section('content')
<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white dark:bg-neutral-800 rounded-lg p-6 max-w-sm mx-4">
        <h3 class="text-lg font-bold mb-4 text-neutral-900 dark:text-white">Confirm Delete</h3>
        <p class="text-neutral-600 dark:text-neutral-300 mb-6">Are you sure you want to delete this user?</p>
        <div class="flex justify-end gap-3">
            <button onclick="closeDeleteModal()"
                class="px-4 py-2 text-sm font-medium text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-700 rounded">
                Cancel
            </button>
            <form id="deleteForm" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-700">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>

<script>
// Auto-hide success message
document.addEventListener('DOMContentLoaded', function() {
    const successMessage = document.querySelector('.bg-green-100');
    if (successMessage) {
        setTimeout(function() {
            successMessage.style.transition = 'opacity 0.5s ease-out';
            successMessage.style.opacity = '0';
            setTimeout(() => successMessage.remove(), 500);
        }, 2000);
    }
});

// Delete modal functionality
function showDeleteModal(userId) {
    const modal = document.getElementById('deleteModal');
    const form = document.getElementById('deleteForm');
    form.action = `/users/${userId}`;
    modal.classList.remove('hidden');
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.add('hidden');
}
</script>
<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-neutral-900 dark:text-white mb-2 flex items-center gap-2">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7" />
                <rect x="14" y="3" width="7" height="7" />
                <rect x="14" y="14" width="7" height="7" />
                <rect x="3" y="14" width="7" height="7" />
            </svg>
            Admin Dashboard
        </h1>
        <p class="text-neutral-600 dark:text-neutral-300">User management.</p>
    </div>
    @if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6 shadow-sm">
        {{ session('success') }}
    </div>
    @endif
    <div class="bg-white dark:bg-neutral-950 shadow-lg rounded-xl overflow-x-auto">
        <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-800">
            <thead>
                <tr class="bg-white">
                    <th class="px-6 py-3 text-left text-xs font-extrabold text-black uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-extrabold text-black uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-extrabold text-black uppercase tracking-wider">Email
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-extrabold text-black uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-extrabold text-black uppercase tracking-wider">Deleted
                        At</th>
                    <th class="px-6 py-3 text-left text-xs font-extrabold text-black uppercase tracking-wider">Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-extrabold text-black uppercase tracking-wider">Action
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-neutral-950 divide-y divide-neutral-100 dark:divide-neutral-800">
                @forelse($users as $user)
                <tr class="{{ $user->deleted_at ? 'bg-red-900/60' : '' }}">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-900 dark:text-white">{{ $user->id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-neutral-900 dark:text-white">
                        {{ $user->name }}
                        @if($user->id === auth()->id())
                        <span
                            class="ml-2 inline-flex items-center px-2 py-1 rounded text-xs font-bold bg-purple-600 text-white">(You)</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-900 dark:text-white">{{ $user->email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($user->is_admin)
                        <span
                            class="inline-flex items-center px-2 py-1 rounded text-xs font-bold bg-blue-700 text-white dark:bg-blue-700 dark:text-white">Admin</span>
                        @else
                        <span
                            class="inline-flex items-center px-2 py-1 rounded text-xs font-bold bg-blue-700 text-white dark:text-white">User</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-xs text-neutral-900 dark:text-white">
                        {{ $user->deleted_at ? $user->deleted_at : '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($user->deleted_at)
                        <span
                            class="inline-flex items-center px-2 py-1 rounded text-xs font-bold bg-red-700 text-white">Inactive</span>
                        @else
                        <span
                            class="inline-flex items-center px-2 py-1 rounded text-xs font-bold bg-green-600 text-white">Active</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($user->deleted_at)
                        <div class="flex flex-col gap-1 items-start">
                            <div class="flex flex-row gap-2 items-center">
                                <!-- View Button triggers inline display -->
                                <button type="button"
                                    onclick="document.getElementById('view-deleted-{{ $user->id }}').classList.toggle('hidden')"
                                    class="inline-flex items-center px-3 py-1.5 rounded bg-blue-600 text-white text-xs font-bold shadow">View</button>
                                <form method="POST" action="{{ route('users.restore', $user->id) }}">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1.5 rounded bg-green-600 text-white text-xs font-bold shadow">Restore</button>
                                </form>
                            </div>
                            <div id="view-deleted-{{ $user->id }}"
                                class="mt-2 w-full p-2 bg-white dark:bg-neutral-800 rounded text-xs text-black dark:text-white hidden border border-neutral-300 dark:border-neutral-700">
                                @php
                                $deleter = null;
                                if ($user->deleted_by) {
                                $deleter = $users->firstWhere('id', $user->deleted_by);
                                }
                                @endphp
                                Deleted by: <span
                                    class="font-bold dark:text-white">{{ $deleter ? $deleter->name : 'Unknown' }}</span>
                            </div>
                        </div>
                        @else
                        <div class="flex flex-row gap-2">
                            @if(!$user->is_admin)
                            <a href="{{ route('users.edit', $user->id) }}"
                                class="inline-flex items-center px-3 py-1.5 rounded bg-yellow-500 text-black text-xs font-bold shadow">Edit</a>
                            <button type="button" onclick="showDeleteModal('{{ $user->id }}')"
                                class="inline-flex items-center px-3 py-1.5 rounded bg-red-600 text-white text-xs font-bold shadow">Delete</button>
                            @endif
                        </div>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-neutral-900 dark:text-white">No users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection