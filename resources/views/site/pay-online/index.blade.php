@extends('site.base.base')
@section('content')
    <div class="container page-block">

        <h1 class="block-title text-center" style="display: block">
            Оплата услуг сайта Проверить-уникальность.рф
        </h1>
        <p style="font-size: 20px">
            На данной странице вы можете произвести оплату за услуги. Пропишите в форме ниже, за какую услугу вы проводите оплату,  а также укажите необходимую сумму.
        </p>
        <pay-online></pay-online>
        <p style="font-weight: 500">Сразу после оплаты мы получим уведомлением о проведении платежа.
            Остались вопросы или не удается провести платеж? Свяжитесь с нами по почте  report@unikaltext.ru
        </p>
    </div>
@endsection
