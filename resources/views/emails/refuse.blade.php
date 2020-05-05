@component('mail::message')

# 
    Hello, 


Sorry, your request has been refused.

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
