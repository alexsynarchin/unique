@extends('site.base.cloudpayments-payment-page-base')
@section('head')
    <script src="https://widget.cloudpayments.ru/bundles/paymentblocks.js"></script>
@endsection
@section('content')
<cloud-payment-form :order="{{$order}}"></cloud-payment-form>

@endsection
