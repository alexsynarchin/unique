@extends('site.base.base')
@section('head')

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
                <a href="/articles" class="breadcrumb-list__link">
                    Cтатьи
                </a>
            </li>
            <li class="breadcrumb-list__item">
                {{$article -> title}}
            </li>
        </ul>

        <div class="row mb-5">
            <div class="col-lg-9">
                <h1 class="page-title">
                    {{$article->title}}
                </h1>
                <div class="article-content">
                    {!! $article->content->text !!}
                </div>
            </div>
            <div class="col-lg-3">
                <section class="vk-subscribe">
                    <h5 class="vk-subscribe__title">Мы во Вконтакте</h5>
                    <a class="vk-subscribe__link" href="https://vk.com/public218705996">
                        <figure class="vk-subscribe__icon">
                            <svg viewBox="0 0 24 24">
                                <use xlink:href={{asset("assets/site/images/sprites.svg?ver=15#sprite-vk")}}></use>
                            </svg>
                        </figure>
                        <span class="vk-subscribe__name">Проверить уникальность</span>
                    </a>
                    <button class="button btn vk-subscribe__btn">Подписаться</button>
                </section>
                <p>Поделиться статьей:</p>
                <script src="https://yastatic.net/share2/share.js"></script>
                <div class="ya-share2" data-curtain data-services="vkontakte,odnoklassniki"></div>
            </div>
        </div>
    </div>
    @include('site.home._partials.mp-banner')
    <div class="container">
        <section class="interesting-articles">
            <h3 class="interesting-articles__title page-title">
                Может быть интересно
            </h3>
            <div class="row">
                @foreach($interesting_articles as $article)
                    <div class="col-lg-4">
                        <a href="/articles/{{$article->slug}}" class="article-item">
                            <section class="article-item__content">
                                <figure class="article-item__preview">
                                    <img src="{{$article->preview}}">
                                </figure>
                                <h3 class="article-item__title">
                                    {{$article->title}}
                                </h3>
                                <div class="article-item__description">
                                    {!! $article->description !!}
                                </div>
                            </section>
                            <div class="article-item__footer">
                                <span class="article-item__date">
                                    {{date('d.m.Y', strtotime($article->date))}}
                                </span>
                                <span class="article-item__views">
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

        </section>
    </div>
@endsection
@section('scripts')
    //

@endsection
