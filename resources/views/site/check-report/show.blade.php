@extends('site.base.base')
@section('content')
    <div class="container">
        <div class="page-heading">
            <h1 class="page-title page-heading__title">
                Отчет №{{$id}}
            </h1>
            <a href="/" class="report-link">
                <span class="report-link__text">
                     Вернуться на главную
                </span>

                <svg viewBox="0 0 10 10" class="report-link__icon">
                    <use xlink:href={{asset("assets/site/images/sprites.svg?ver=17#sprite-dig-arrow")}}></use>
                </svg>
            </a>
        </div>
        <report-page :id="{{$id}}"></report-page>
    </div>
@endsection
