<x-mail::message>
# Welcome to {{ $companyName }}

Hello {{ $admin->name }},
You have been successfully registered as a user for **{{ $companyName }}**.

## Your Login Credentials

**Username (Email):** {{ $admin->email }}
**Temporary Password:** {{ $password }}

---

**Important:** For security reasons, we recommend that you reset your password immediately after your first login.

<x-mail::button :url="$resetUrl">
Reset Password
</x-mail::button>

Or you can login with the temporary password:

<x-mail::button :url="url('/superadmin/login')">
Go to Login
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
