@component('mail::message')
# Dear {{ $data['owner'] }}

User {{ $data['booker'] }} has requested a book from you: <br>
 <ul style="list-style-type: none">
  <li>User: <strong>{{ $data['booker'] }}</strong>, <a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a>
  <li>User is from: {{ $data['address'] }}</li>
  <li>Requested Title: <strong>{{ $data['title'] }}</strong> 
   by <strong>{{ $data['author'] }}</strong></li>
 </ul>

Get in touch, and have fun sharing.

@component('mail::button', ['url' => 'localhost:8000'])
Go to Site
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
