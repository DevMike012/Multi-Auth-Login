
<div class="flex flex-col gap-2 min-w-[240px]">
    <!-- Theme Selector -->
    <div class="px-4 py-2 bg-gray-900 rounded-lg shadow-md">
        <label for="dashboard-style" class="block text-xs text-gray-300 mb-1 font-medium">Theme</label>
        <select id="dashboard-style"
            class="w-full rounded-md bg-gray-800 text-white px-3 py-1.5 border border-gray-700 focus:border-gray-600 focus:ring-1 focus:ring-gray-600 outline-none"
            onchange="document.documentElement.classList.remove('theme-default','theme-dark','theme-light');document.documentElement.classList.add('theme-' + this.value);localStorage.setItem('dashboard-theme', this.value);">
            <option value="default">Default</option>
            <option value="dark">Dark</option>
            <option value="light">Light</option>
        </select>
    </div>

    <script>
    // Theme initialization
    (function() {
        var theme = localStorage.getItem('dashboard-theme') || 'default';
        document.getElementById('dashboard-style').value = theme;
        document.documentElement.classList.remove('theme-default', 'theme-dark', 'theme-light');
        document.documentElement.classList.add('theme-' + theme);
    })();
    </script>

    <!-- Main Menu -->
    <div class="bg-gray-900 rounded-lg shadow-md">
        <!-- Dashboard Link -->
        <a href="<?php echo e(route('admin.overview')); ?>"
            class="flex items-center gap-3 px-4 py-3 hover:bg-gray-800/50 active:bg-gray-700/50 transition-colors rounded-t-lg no-underline">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="font-medium">Overview</span>
        </a>

        <!-- User Management Dropdown -->
        <div class="border-t border-gray-800">
            <a href="<?php echo e(route('admin.dashboard')); ?>"
                class="flex items-center gap-3 px-4 py-3 hover:bg-gray-800/50 transition-colors no-underline">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span class="font-medium">User Management</span>
            </a>
        </div>

        <!-- Profile Link -->
        <div class="border-t border-gray-800">
            <a href="<?php echo e(route('profile.edit')); ?>"
                class="flex items-center gap-3 px-4 py-3 hover:bg-gray-800/50 transition-colors no-underline">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="font-medium">Profile</span>
            </a>
        </div>

        <!-- Logout -->
        <div class="border-t border-gray-800">
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit"
                    class="flex items-center gap-3 px-4 py-3 w-full hover:bg-gray-800/50 active:bg-gray-700/50 transition-colors rounded-b-lg no-underline">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span class="font-medium">Logout</span>
                </button>
            </form>
        </div>
    </div>
</div>

<style>
.dropdown-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-out;
}

.dropdown-content.show {
    max-height: 200px;
    /* Adjust based on content */
}
</style><?php /**PATH C:\xampp\htdocs\LoginAuth\resources\views/layouts/menu.blade.php ENDPATH**/ ?>