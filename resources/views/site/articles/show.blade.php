@extends('site.base.base')
@section('content')
    <div class="container">
        <ul class="breadcrumb-list">
            <li class="breadcrumb-list__item">
                <a href="/" class="breadcrumb-list__link">
                    Главная
                </a>
            </li>
            <li class="breadcrumb-list__item">
                <a href="/articles" class="breadcrumb-list__link">
                    Cтатьи
                </a>
            </li>
            <li class="breadcrumb-list__item">
                {{$article -> title}}
            </li>
        </ul>

        <div class="row">
            <div class="col-lg-9">
                <h1 class="page-title">
                    {{$article->title}}
                </h1>
            </div>
            <div class="col-lg-3">
                <section class="vk-subscribe">
                    <h5 class="vk-subscribe__title">Мы во Вконтакте</h5>
                    <a class="vk-subscribe__link" href="">
                        <figure class="vk-subscribe__icon">
                            <svg viewBox="0 0 24 24">
                                <use xlink:href={{asset("assets/site/images/sprites.svg?ver=15#sprite-vk")}}></use>
                            </svg>
                        </figure>
                        <span class="vk-subscribe__name">Проверить уникальность</span>
                    </a>
                    <button class="button btn vk-subscribe__btn">Подписаться</button>
                </section>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-lg-9 article-content">
                {!! $article->content->text !!}
            </div>
            <div class="col-lg-3">

            </div>
        </div>
    </div>
    @include('site.home._partials.mp-banner')
@endsection

