@extends('site.base.base')
@section('content')
    <div class="container">
        <order-fail :url="{{json_encode($url)}}"></order-fail>
    </div>
@endsection
