<label>Имя:</label> {{$contact->name}}<br>
<label>Телефон:</label>{{$contact->phone}}<br>
<label>Почта:</label>{{$contact->email}}<br>
<label>Необходимые сроки:</label>{{$contact->date}}<br>
<label>Комментарий:</label><br>
@if(!$contact->filename)
<label>Текст:</label><br>
{{$contact->plain_text}}<br>
{{$contact->comment}}
@endif
