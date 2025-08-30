

<?php $__env->startSection('content'); ?>
<div class="max-w-lg mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold mb-6">Edit User</h1>
    <form method="POST" action="<?php echo e(route('users.update', $user->id)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Name</label>
            <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>"
                class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>"
                class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Password <span class="text-xs text-gray-500">(leave blank to
                    keep current)</span></label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded font-bold">Update User</button>
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="ml-4 text-blue-600">Cancel</a>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LoginAuth\resources\views/admin/edit-user.blade.php ENDPATH**/ ?>