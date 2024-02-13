<x-mail::message>
# Thank you for joining us! We're thrilled to have you on board, and we look forward to crafting your experience with care and creativity here at Eighty Eight!
<br/>
<p>Please verify your email address by clicking the button below.</p>

<x-mail::button :url="$url">
Verify Now
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
