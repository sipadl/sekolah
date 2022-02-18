@component('mail::message')
{{$data['title'] }}

@component('mail::button', ['url' => $data['url']])
Kembali
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
