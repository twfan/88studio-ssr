<x-mail::message>
# Hey {{$transaction->user->name}}, Your Project is Now complete! !
<br/>
<p>Please proceed by clicking the designated button to review the completed project with 88 Studio. Your feedback is highly appreciated, so don't forget to share your thoughts with us by leaving a review. Additionally, feel free to utilize the chat section for any inquiries or updates regarding your project.</p>

<x-mail::button :url="$url">
Check Now
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
