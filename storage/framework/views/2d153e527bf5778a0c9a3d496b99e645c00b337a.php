

<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4 py-12">
    <div class="max-w-md w-full bg-white border border-gray-200 rounded-2xl shadow-md p-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl lg:text-4xl font-extrabold text-gray-800">Create an Account</h1>
                <p class="mt-2 text-base text-gray-500">Choose the account type to register.</p>
            </div>
            <div class="flex-shrink-0">
                <!-- refined user-add icon -->
                <svg class="w-14 h-14 text-green-600" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M15 7a3 3 0 11-6 0 3 3 0 016 0z" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M4 20c0-3 3.5-5 8-5s8 2 8 5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M19 8v4" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M21 10h-4" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </div>

        <div class="space-y-4">
            <a href="<?php echo e(route('register', ['register_as' => 'user', 'role' => 'user'])); ?>" class="block w-full text-left px-6 py-4 rounded-xl bg-gradient-to-r from-white to-indigo-50 border border-gray-200 hover:shadow-xl transition flex items-center gap-5">
                <div class="flex items-center justify-center w-14 h-14 bg-indigo-100 rounded-lg">
                    <svg class="w-8 h-8 text-indigo-600" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 12a4 4 0 100-8 4 4 0 000 8z" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4 20c0-3.314 4-6 8-6s8 2.686 8 6" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div>
                    <div class="text-lg lg:text-xl font-semibold text-gray-900">Register as User</div>
                    <div class="text-sm text-gray-500">Personal account for using the application</div>
                </div>
                <div class="ml-auto flex items-center gap-2 text-sm text-indigo-600 font-semibold">
                    <span>Create</span>
                    <svg class="w-4 h-4" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M7 4l6 6-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
            </a>

            <a href="<?php echo e(route('register', ['register_as' => 'admin', 'role' => 'admin'])); ?>" class="block w-full text-left px-6 py-4 rounded-xl bg-gradient-to-r from-white to-yellow-50 border border-gray-200 hover:shadow-xl transition flex items-center gap-5">
                <div class="flex items-center justify-center w-14 h-14 bg-yellow-100 rounded-lg">
                    <svg class="w-8 h-8 text-yellow-600" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 2l7 4v6c0 5-3.8 9.7-7 11-3.2-1.3-7-6-7-11V6l7-4z" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M10 11l2 2 4-4" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div>
                    <div class="text-lg lg:text-xl font-semibold text-gray-900">Register as Admin</div>
                    <div class="text-sm text-gray-500">Administrative account with elevated privileges</div>
                </div>
                <div class="ml-auto flex items-center gap-2 text-sm text-indigo-600 font-semibold">
                    <span>Create</span>
                    <svg class="w-4 h-4" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M7 4l6 6-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
            </a>
        </div>

        <div class="mt-6 text-center text-sm text-gray-500">
            Already have an account?
            <a href="<?php echo e(route('choose.login')); ?>" class="text-indigo-600 font-medium">Sign in</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LoginAuth\resources\views/auth/choose-register.blade.php ENDPATH**/ ?>