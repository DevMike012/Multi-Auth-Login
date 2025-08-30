

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-neutral-900 dark:text-white mb-2 flex items-center gap-2">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7" />
                <rect x="14" y="3" width="7" height="7" />
                <rect x="14" y="14" width="7" height="7" />
                <rect x="3" y="14" width="7" height="7" />
            </svg>
            Dashboard Overview
        </h1>
        <p class="text-neutral-600 dark:text-neutral-300">System statistics and quick actions.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Total Users Card -->
        <div class="bg-emerald-500 rounded-xl p-6 shadow-lg">
            <div class="flex flex-col">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-white text-lg font-semibold">Active</h2>
                    <svg class="w-8 h-8 text-white opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex items-end justify-between">
                    <div>
                        <span class="text-4xl font-bold text-white"><?php echo e($activeUsers); ?></span>
                        <p class="text-white text-sm opacity-75">Active Users</p>
                    </div>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-white text-sm">More Info →</a>
                </div>
            </div>
        </div>

        <!-- Admins Card -->
        <div class="bg-blue-600 rounded-xl p-6 shadow-lg">
            <div class="flex flex-col">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-white text-lg font-semibold">Admin</h2>
                    <svg class="w-8 h-8 text-white opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div class="flex items-end justify-between">
                    <div>
                        <span class="text-4xl font-bold text-white"><?php echo e($adminCount); ?></span>
                        <p class="text-white text-sm opacity-75">Admin Users</p>
                    </div>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-white text-sm">More Info →</a>
                </div>
            </div>
        </div>

        <!-- Regular Users Card -->
        <div class="bg-orange-500 rounded-xl p-6 shadow-lg">
            <div class="flex flex-col">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-white text-lg font-semibold">Users</h2>
                    <svg class="w-8 h-8 text-white opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div class="flex items-end justify-between">
                    <div>
                        <span class="text-4xl font-bold text-white"><?php echo e($regularUsers); ?></span>
                        <p class="text-white text-sm opacity-75">Regular Users</p>
                    </div>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-white text-sm">More Info →</a>
                </div>
            </div>
        </div>

        <!-- Deleted Users Card -->
        <div class="bg-blue-500 rounded-xl p-6 shadow-lg">
            <div class="flex flex-col">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-white text-lg font-semibold">Deleted</h2>
                    <svg class="w-8 h-8 text-white opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <div class="flex items-end justify-between">
                    <div>
                        <span class="text-4xl font-bold text-white"><?php echo e($deletedUsers); ?></span>
                        <p class="text-white text-sm opacity-75">Deleted Users</p>
                    </div>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-white text-sm">More Info →</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="bg-white dark:bg-neutral-950 rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-neutral-900 dark:text-white mb-4">Recent Activity</h2>
        <div class="space-y-4">
            <?php $__empty_1 = true; $__currentLoopData = $recentActivity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="flex items-center gap-4 p-3 bg-white/5 backdrop-blur-sm border border-white/10 rounded-lg">
                <div class="p-2 rounded-full
                    <?php if($activity->type === 'deleted'): ?>
                        bg-red-100/10 dark:bg-red-500/10
                    <?php elseif($activity->type === 'updated'): ?>
                        bg-yellow-100/10 dark:bg-yellow-500/10
                    <?php elseif($activity->type === 'restored'): ?>
                        bg-green-100/10 dark:bg-green-500/10
                    <?php else: ?>
                        bg-blue-100/10 dark:bg-blue-500/10
                    <?php endif; ?>">
                    <svg class="w-5 h-5
                        <?php if($activity->type === 'deleted'): ?>
                            text-red-500
                        <?php elseif($activity->type === 'updated'): ?>
                            text-yellow-500
                        <?php elseif($activity->type === 'restored'): ?>
                            text-green-500
                        <?php else: ?>
                            text-blue-500
                        <?php endif; ?>" 
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <?php if($activity->type === 'deleted'): ?>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        <?php elseif($activity->type === 'updated'): ?>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        <?php elseif($activity->type === 'restored'): ?>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        <?php else: ?>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        <?php endif; ?>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-neutral-900 dark:text-white"><?php echo e($activity->description); ?></p>
                    <p class="text-xs text-neutral-500 dark:text-neutral-400"><?php echo e($activity->created_at->diffForHumans()); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center text-neutral-500 dark:text-neutral-400 py-4">
                No recent activity
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LoginAuth\resources\views/admin/overview.blade.php ENDPATH**/ ?>