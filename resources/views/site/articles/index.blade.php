@extends('site.base.base')
@section('head')
    <link rel="canonical" href="https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/articles"/>
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
                Cтатьи
            </li>
        </ul>
        <h1 class="page-title">
            Cтатьи
        </h1>
        <div class="row">
            <div class="col-lg-9">
                <div class="article-list">
                    @foreach ($articles as $article)
                        <div class="article-list__item">
                        <a href="/articles/{{$article -> slug}}" class="article-item">
                            <section class="article-item__content">
                            <figure class="article-item__preview">
                                <img src="{{$article -> preview}}">
                            </figure>
                            <h3 class="article-item__title">
                                {{$article -> title}}
                            </h3>
                            <div class="article-item__description" >
                                {!! $article -> description !!}}
                            </div>

                        </section>
                        <div class="article-item__footer">
                            <span class="article-item__date">
                                {{date('d.m.Y', strtotime($article -> date))}}
                            </span>
                            <span class="article-item__views">

                            </span>
                        </div>
                    </a>
            </div>

                    @endforeach
                </div>
                {{ $articles->links('site.components.pagination') }}
            </div>
            <div class="col-lg-3">
                <sidebar-banner></sidebar-banner>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection

