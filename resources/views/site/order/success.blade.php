@extends('site.base.base')
@section('content')
    <div class="container">
        <order-success :url="{{json_encode($url)}}"></order-success>
    </div>
@endsection
