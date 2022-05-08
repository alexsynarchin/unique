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
                Отзывы
            </li>
        </ul>
        <div class="page-heading">
            <h1 class="page-title page-heading__title">
                Отзывы
            </h1>
            <reviews-filters></reviews-filters>
        </div>
        <reviews-page></reviews-page>
    </div>
@endsection

