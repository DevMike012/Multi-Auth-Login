

<?php $__env->startSection('content'); ?>
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
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
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
    <?php if(session('success')): ?>
    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6 shadow-sm">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>
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
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="<?php echo e($user->deleted_at ? 'bg-red-900/60' : ''); ?>">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-900 dark:text-white"><?php echo e($user->id); ?>

                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-neutral-900 dark:text-white">
                        <?php echo e($user->name); ?>

                        <?php if($user->id === auth()->id()): ?>
                        <span
                            class="ml-2 inline-flex items-center px-2 py-1 rounded text-xs font-bold bg-purple-600 text-white">(You)</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-900 dark:text-white"><?php echo e($user->email); ?>

                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <?php if($user->is_admin): ?>
                        <span
                            class="inline-flex items-center px-2 py-1 rounded text-xs font-bold bg-blue-700 text-white dark:bg-blue-700 dark:text-white">Admin</span>
                        <?php else: ?>
                        <span
                            class="inline-flex items-center px-2 py-1 rounded text-xs font-bold bg-blue-700 text-white dark:text-white">User</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-xs text-neutral-900 dark:text-white">
                        <?php echo e($user->deleted_at ? $user->deleted_at : '-'); ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <?php if($user->deleted_at): ?>
                        <span
                            class="inline-flex items-center px-2 py-1 rounded text-xs font-bold bg-red-700 text-white">Inactive</span>
                        <?php else: ?>
                        <span
                            class="inline-flex items-center px-2 py-1 rounded text-xs font-bold bg-green-600 text-white">Active</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <?php if($user->deleted_at): ?>
                        <div class="flex flex-col gap-1 items-start">
                            <div class="flex flex-row gap-2 items-center">
                                <!-- View Button triggers inline display -->
                                <button type="button"
                                    onclick="document.getElementById('view-deleted-<?php echo e($user->id); ?>').classList.toggle('hidden')"
                                    class="inline-flex items-center px-3 py-1.5 rounded bg-blue-600 text-white text-xs font-bold shadow">View</button>
                                <form method="POST" action="<?php echo e(route('users.restore', $user->id)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1.5 rounded bg-green-600 text-white text-xs font-bold shadow">Restore</button>
                                </form>
                            </div>
                            <div id="view-deleted-<?php echo e($user->id); ?>"
                                class="mt-2 w-full p-2 bg-white dark:bg-neutral-800 rounded text-xs text-black dark:text-white hidden border border-neutral-300 dark:border-neutral-700">
                                <?php
                                $deleter = null;
                                if ($user->deleted_by) {
                                $deleter = $users->firstWhere('id', $user->deleted_by);
                                }
                                ?>
                                Deleted by: <span
                                    class="font-bold dark:text-white"><?php echo e($deleter ? $deleter->name : 'Unknown'); ?></span>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="flex flex-row gap-2">
                            <?php if(!$user->is_admin): ?>
                            <a href="<?php echo e(route('users.edit', $user->id)); ?>"
                                class="inline-flex items-center px-3 py-1.5 rounded bg-yellow-500 text-black text-xs font-bold shadow">Edit</a>
                            <button type="button" onclick="showDeleteModal('<?php echo e($user->id); ?>')"
                                class="inline-flex items-center px-3 py-1.5 rounded bg-red-600 text-white text-xs font-bold shadow">Delete</button>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-neutral-900 dark:text-white">No users found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LoginAuth\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>