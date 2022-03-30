@extends('site.base.base')
@section('head')
    <link rel="stylesheet" href="{{asset('assets/site/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/owl.theme.default.min.css')}}">
@endsection
@section('content')
    @include('site.home._partials.utp')
    @include('site.home._partials.advantages')
    <div class="container">
        <check-unique></check-unique>
    </div>
    @include('site.home._partials.why')
    @include('site.home._partials.mp-process')
    @include('site.home._partials.mp-banner')
    @include('site.home._partials.mp-about')
    @include('site.home._partials.reviews')
@endsection
@section('scripts')
    <script src="{{asset('assets/site/js/main-page.js?ver=33')}}"></script>
@endsection
