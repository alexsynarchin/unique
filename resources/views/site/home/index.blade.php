@extends('site.base.base')
@section('head')
    <link rel="stylesheet" href="{{asset('assets/site/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/css/owl.theme.default.min.css')}}">

@endsection
@section('content')
    <div class="container">
        <section class="check-unique-bl" id="check_unique">
            <div class="text-center">
                <h1 class="block-title  check-unique-bl__title">
                    Проверить уникальность текста онлайн бесплатно <span class="block-title__cursor"></span>
                </h1>
                <p class="check-unique-bl__text">
                    Все системы проверки в одном месте
                </p>
            </div>
            <check-unique></check-unique>
        </section>
    </div>
    @include('site.home._partials.advantages')
    @include('site.home._partials.utp')
    @include('site.home._partials.why')
    @include('site.home._partials.mp-process')
    @include('site.home._partials.mp-banner')
    @include('site.home._partials.mp-about')
    @include('site.home._partials.reviews')
    @include('site.home._partials.faq')


@endsection
@section('scripts')
    <script src="{{asset('assets/site/js/main-page.js?ver=36')}}"></script>
@endsection
