@extends('site.base.base')
@section('head')
    <link rel="stylesheet" href="{{asset('assets/site/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/owl.theme.default.min.css')}}">
@endsection
@section('content')
    <div class="container">
        <ul class="breadcrumb-list">
            <li class="breadcrumb-list__item">
                <a href="/" class="breadcrumb-list__link">
                    Главная
                </a>
            </li>
            <li class="breadcrumb-list__item">
                О компании
            </li>
        </ul>
        <h1 class="page-title">
            О компании
        </h1>
        @include('site.about._partials.utp')
        @include('site.about._partials.advantages')
        @include('site.about._partials.warranty')
        @include('site.about._partials.result')
        @include('site.home._partials.mp-banner')
    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets/site/js/main-page.js?ver=33')}}"></script>
@endsection
