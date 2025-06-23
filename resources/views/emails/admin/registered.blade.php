<x-mail::message>
# Welcome to {{ $companyName }}

Hello {{ $admin->name }},  
You have been successfully registered as the admin for **{{ $companyName }}**.

---

<x-mail::button :url="url('/login')">
Go to Admin Panel
</x-mail::button>

If you'd like to change your password, click the button below:

<x-mail::button :url="url('/password/reset')">
Reset Password
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
