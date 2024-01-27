@component('mail::message')
hello {{$user->name}},
<p>We understand it happens.</p>
@component('mail::button',['url'=>url('/reset'.$user->remember_token)])
Reset Your Password
@endcomponent
<p>Incase you have any issues recovering your Password, Please Conact us.</p>
Thanks,<br>
{{config('app.name')}}
@endcomponent