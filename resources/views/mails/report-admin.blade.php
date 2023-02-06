<h4>Запрос №{{$order->checkUnique->id}}</h4>
<label>Почта: </label> {{$order->checkUnique->email}}<br>
<label>Сумма: </label> {{$order->sum}}
<label>Системы проверки: </label>
    @foreach($order->reports as $report)
        {{$report->checkSystem->title}}@if(!$loop->last),@endif
    @endforeach<br>
