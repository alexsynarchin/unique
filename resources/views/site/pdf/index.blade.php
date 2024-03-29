<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Отчет о проверке уникальности</title>
    <style>

       @import url("{{asset('assets/site/css/pdf-catalog.css?ver=65')}}");
    </style>
</head>
<body>
<section class="pdf-catalog">
    <header class="header">
        <section class="header__left">
            <div class="logo">
                УНИКАЛЬНОСТЬ
            </div>
            <div class="header__descr">
                Все системы проверки в одном месте
            </div>
        </section>
        <section class="header__right">
            <span class="header__phone">
                {{$phone}}
            </span>
            <span class="header__link">
                проверить-уникальность.рф
            </span>
        </section>
    </header>
    <div class="report-item-descr">
        <figure class="report-item-descr__icon">
            <img src="https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/assets/site/images/union.png">
        </figure>
        <div class="report-item-descr__content">
            <p class="report-item-descr__text">
                Обращаем ваше внимание,
                что система отвечает на вопрос,
                является тот или иной фрагмент текста заимствованным или нет.
                Ответ на вопрос, является ли фрагмент именно плагиатом,
                а не законной цитатой, система оставляет на ваше усмотрение.
            </p>

        </div>
    </div>
    <h1 class="page-title">
        Отчет о проверке № {{$report->check_unique_id}} <br>
        ({{$report->checkSystem->title}})
    </h1>
    <div class="report-information">
        <div class="report-information__item">
            <h3 class="report-information__title">
                Информация об отчете
            </h3>
            <ul class="report-information-list">
                <li class="report-information-list__item">
                    <label class="report-information-list__label">
                        Дата:
                    </label>
                    <span class="report-information-list__value">
                        {{$report->formatted_date}}
                    </span>
                </li>
                <li class="report-information-list__item">
                    <label class="report-information-list__label">
                        ID пользователя:
                    </label>
                    <span class="report-information-list__value">
                        {{$report->id}}
                    </span>
                </li>
                <li class="report-information-list__item">
                    <label class="report-information-list__label">
                        Процент уникальности:
                    </label>
                    <span class="report-information-list__value">
                        {{$report->data['unique']}}%
                    </span>
                </li>
            </ul>
            <section class="report-progress-bar">
                <div class="report-progress-bar__line">
                    <div style="width: {{$report->data['unique']}}% " class="report-progress-bar__line-percent"></div>
                </div>
                <div class="report-progress-bar__text">
                    {{$report->data['unique']}}%  @if($report->data['unique'] > 70 ) Текст уникальный @elseтекст неуникальный @endif
                </div>
            </section>
            <a href="https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/report/{{$report->checkUnique->slug}}" class="report-information__link">
                Посмотреть отчет на сайте
            </a>
        </div>

        <div class="report-information__item">
            <h3 class="report-information__title">
                Информация о документе
            </h3>
            <ul class="report-information-list">
                <li class="report-information-list__item">
                    <label class="report-information-list__label">
                        Символов:
                    </label>
                    <span class="report-information-list__value">
                        {{$report->checkUnique->symbolsCount}}
                    </span>
                </li>
                <li class="report-information-list__item">
                    <label class="report-information-list__label">
                        Слов:
                    </label>
                    <span class="report-information-list__value">
                        {{$report->checkUnique->wordsCount}}
                    </span>
                </li>
                <li class="report-information-list__item">
                    <label class="report-information-list__label">
                        Страниц:
                    </label>
                    <span class="report-information-list__value">
                        {{$report->checkUnique->pages}}
                    </span>
                </li>
            </ul>
        </div>
    </div>
    <h3 class="report-information__title">Заимствования:</h3>
    <ul class="report-item-links">
        @foreach($report->data['urls'] as $item)
            <li class="report-item-links__item" >
                <section class="report-item-links__text">
                    <span class="report-item-links__percent">
                    {{$item['plagiat']  . '%'}}
                    </span>
                    <span class="report-item-links__url">
                    {{$item['url']}}
                    </span>
                </section>
            </li>
        @endforeach
    </ul>
    <div class="report-text">
        {!! $report->highlight_text !!}
    </div>
</section>
</body>
</html>
