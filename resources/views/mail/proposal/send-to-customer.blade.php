<x-mail::message>
# Hey {{$transaction->user->name}}, Delighted to announce that Eighty Eight will be crafting your commission with care and creativity!
<br/>
<p>Kindly proceed by clicking the designated button to initiate the payment process.</p>

<x-mail::button :url="$url">
Pay Now
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
