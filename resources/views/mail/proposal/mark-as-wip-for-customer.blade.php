<x-mail::message>
# Hey {{$transaction->user->name}}, Your Project is Now in Progress! !
<br/>
<p>Please proceed by clicking the designated button to track the progress with 88 Studio. Additionally, feel free to utilize the chat section for any inquiries or updates regarding your project.</p>

<x-mail::button :url="$url">
Check Now
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
