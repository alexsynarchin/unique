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
                {{$page->name}}
            </li>
        </ul>
        <h1 class="page-title">
            {{$page->name}}
        </h1>
        {!! $page->content -> text !!}
        @include('site.home._partials.mp-banner')
    </div>
@endsection
