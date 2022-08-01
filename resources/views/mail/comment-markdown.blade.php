@component('mail::message')
# Nuovo commento

Post commentato: {{$comment->post->title}}

@component('mail::button', ['url' => route('admin.comments.index')])
Visualizza Commenti
@endcomponent

Grazie,<br>
{{ config('app.name') }}
@endcomponent
