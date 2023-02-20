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
                <div id="vk_groups" style="width:100%"></div>
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
    <script type="text/javascript">
        VK.Widgets.Group("vk_groups", {mode: 3, color1: 'F0F1F6', width:230}, 218705996);
    </script>

@endsection
