<p>Hello <?php echo e($user->name ?? $user->email); ?>,</p>

<p>Your password has been temporarily reset. Use the following temporary password to log in and then change your password immediately:</p>

<p><strong><?php echo e($tempPassword); ?></strong></p>

<p>After logging in you'll be prompted to set a new password.</p>

<p>If you did not request this change, please contact support.</p>

<p>Regards,<br><?php echo e(config('app.name')); ?></p>
<?php /**PATH C:\xampp\htdocs\LoginAuth\resources\views/emails/temporary-password.blade.php ENDPATH**/ ?>