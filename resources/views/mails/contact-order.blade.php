<label>Имя:</label> {{$contact['name']}}<br>
<label>Телефон:</label>{{$contact['phone']}}<br>
<label>Почта:</label>{{$contact['email']}}<br>
<label>Комментарий:</label><br>
@if(isset($contact['comment']))
    {{$contact['comment']}}
@endif

