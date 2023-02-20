<h4>Запрос №{{$order->checkUnique->id}}</h4>
<label>Почта: </label> {{$order->checkUnique->email}}<br>
<label>Сумма: </label> {{$order->sum}} руб.<br>
<label>Системы проверки: </label>
    @foreach($order->reports as $report)
        {{$report->checkSystem->title}}@if(!$loop->last),@endif
    @endforeach<br>
<label>Дополнительные услуги:</label>
@foreach($order->checkUnique->services as $service)
    {{$service->title}}
    @if(!$loop->last),@endif
@endforeach
<br>
<label>Страница запроса в админ панели:</label>
<a href="https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/admin/check-uniques/show/{{$order->checkUnique->id}}">
    Перейти
</a>
