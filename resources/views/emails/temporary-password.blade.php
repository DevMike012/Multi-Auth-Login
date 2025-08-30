<p>Hello {{ $user->name ?? $user->email }},</p>

<p>Your password has been temporarily reset. Use the following temporary password to log in and then change your password immediately:</p>

<p><strong>{{ $tempPassword }}</strong></p>

<p>After logging in you'll be prompted to set a new password.</p>

<p>If you did not request this change, please contact support.</p>

<p>Regards,<br>{{ config('app.name') }}</p>
