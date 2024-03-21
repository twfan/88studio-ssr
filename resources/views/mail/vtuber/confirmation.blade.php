<x-mail::message>
<div class="w-full text-center font-bold text-xl text-gray-800" style="width:100%; text-align:center; font-weight:700; font-size: 1.25rem; line-height:1.75rem;">
    Your Order Confirmation
</div>
<br/>
{{-- <x-mail::table>
    |  |  |  |
    | ------ | -----------:| -----------:|
    | {{$product->product_name}}   | 1x     | ${{$product->price}} |
</x-mail::table>
<x-mail::table>
    |  |  |  |
    | ------ | -----------:| -----------:|
    | Total   |      | ${{$transaction->grand_total}} |
</x-mail::table> --}}

<hr style="margin-bottom:20px;margin-top:5px;"/>

<table style="width:100%;text-align:center;margin-bottom:20px;">
    <tr>
        <td style="text-align: left">{{$product->product_name}}</td>
        <td>1x</td>
        <td style="text-align: right;">${{$product->price}}</td>
    </tr>
</table>
<hr style="margin-bottom: 20px;"/>
<table style="width:100%;text-align:center;margin-bottom:20px;">
    <tr>
        <td style="text-align: left;font-weight:700;">Total</td>
        <td></td>
        <td style="text-align: right;font-weight:700;">${{$transaction->grand_total}}</td>
    </tr>
</table>

<x-mail::button :url="$url">
View Order
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
