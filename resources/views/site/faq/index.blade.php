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
                Вопросы и ответы
            </li>
        </ul>
        <h1 class="page-title">
            Вопросы и ответы
        </h1>
        <div class="row">
            <div class="col-lg-9">
                <faq-page></faq-page>
            </div>
            <div class="col-lg-3">
                <sidebar-banner></sidebar-banner>
            </div>
        </div>
        @include('site.home._partials.mp-banner')
    </div>
@endsection

