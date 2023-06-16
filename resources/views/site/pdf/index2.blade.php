<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Отчет о проверке уникальности</title>
    <style>
        body { font-family: DejaVu Sans }
        .highlight--red {
            color: red;
        }
        .pdf-catalog{
            position:relative;
            margin-left: auto;
            margin-right: auto;
            width: 660px;
            padding: 38px;
        }
        .page-title {
            text-align: center;
            font-weight: 700;
            font-size: 17.3544px;
            margin-bottom: 22px;
        }
        .report-text {
            background: #F0F1F6;
            border-radius: 3.09901px;
            padding: 11px;
            font-size: 8.67722px;
            color: #000000;
        }
        .header {
            width: 100%;
            padding-bottom: 12px;
            border-bottom: 0.5px solid #CDD3E4;

            margin-bottom: 24px;
        }
        .header__left {
            width: 24%;
        }
        .header__right {
            width:50% ;
        }
        .header__descr {

            font-size: 8px;
            color: #ABAFC3;
        }
        .header__phone {
            font-weight: bold;
            font-size: 11px;
            margin-right: 11px;
        }
        .header__link {
            font-weight: bold;
            font-size: 11px;
            color:#366AF3;
        }
        .logo {

            position: relative;
            font-weight: 700;
            font-size: 14px;
            padding-right: 3px;

        }
        .logo__decor {

          display: inline-block;
            width: 2px;
            height: 15px;
            background-color:#366AF3;
        }
        .report-item-descr {
            margin-bottom: 31px;
            position: relative;

        }
        .report-item-descr__icon {
            position: relative;

            background-color: #E3E5ED;
            border-radius: 100%;

            width: 52px;
            height: 52px;
            margin: 0;
        }
        .report-item-descr__icon img {
            position: absolute;
            top:50%;
            left: 50%;
            transform: translate(-50%,-50%);
            width:9px;
        }
        .report-item-descr__content {
            overflow: hidden;
            position: relative;
            background: #E3E5ED;
            height: 52px;
            padding-left: 20px;
            padding-right: 20px;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        .report-item-descr__content-decor {
            position: absolute;
            background-color: #ffffff;
            width: 70px;
            height: 70px;
            border-radius: 100%;
            left: -60px;
            top: -9px;
        }
        .report-item-descr__text {
            font-size: 8px;
            padding-top:9px;
            padding-bottom: 9px;
            margin-bottom: 0;
        }
        .report-information {
            margin-bottom: 30px;
        }
        .report-information__title {
            font-weight: 700;
            font-size: 12px;
            margin-bottom: 13px;
        }
        .report-information__item {
            width: 50%;
            vertical-align: top;
        }
        .report-information__link {
            color: #ABAFC3;
            text-decoration: underline;

            font-size: 14px;
        }
        .report-information__link:hover {
            color: #ABAFC3;
            text-decoration: underline;
        }
        .report-information-list {
            padding-left: 0;
            margin-left: 0;
            list-style-type: none;
            margin-bottom: 15px;
        }
        .report-information-list__item {
            font-size: 9px;
            margin-bottom: 5px;
        }
        .report-information-list__label {
            margin-bottom: 0;
            color: #ABAFC3;
        }
        .report-progress-bar {
            margin-bottom: 10px;
        }
        .report-progress-bar__line {
            overflow: hidden;
            position: relative;
            background: #E3E5ED;
            border-radius: 30.9901px;
            width: 256.91px;
            height: 9.92px;
            margin-bottom: 7px;
        }
        .report-progress-bar__line-percent {
            position: absolute;
            top: 0;
            left: 0;
            height: 9.92px;
            width: 0px;
            background: #366AF3;
            border-radius: 30.9901px;
        }
        .report-progress-bar__text {

            font-size: 10px;
            color: #366AF3;
        }
        .report-item-links {
            width: 100%;
            margin-bottom: 16px;
            border-spacing: 0px;
            border-collapse: collapse;
        }
        .report-item-links__item {
            background: #E3E5ED;
            border-bottom-left-radius: 5px;
            border-top-left-radius: 5px;
            margin-bottom: 10px;
            font-size: 8px;
        }
        .report-item-links__percent {
            font-size: 15px;
            font-weight: 700;
            padding: 4px 7px;
            color:#366AF3;
            width:65px;
            border-bottom-right-radius: 30px;
            border-top-right-radius: 30px;
            border-right: 2px solid #ffff
        }
        .report-item-links__url {
            padding: 4px 7px;
            word-break: break-word;
        }
    </style>
</head>
<body>
<section class="pdf-catalog">
    <table class="header">
        <tr>
            <td class="header__left">
                <div class="logo">
                    УНИКАЛЬНОСТЬ <div class="logo__decor"></div>
                </div>
            </td>
            <td class="header__descr">
                Все системы проверки в одном месте
            </td>
            <td align="right" class="header__right">
                 <span class="header__phone">
                    {{$phone}}
                </span>
                <span class="header__link">
                    проверить-уникальность.рф
                </span>
            </td>
        </tr>
    </table>
    <table>
        <tr class="report-item-descr">
            <td style="border-collapse: collapse; padding: 0">
                <div class="report-item-descr__icon">
                    <img src="https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/assets/site/images/union.png">
                </div>
            </td>
            <td style="  border-collapse: collapse; padding: 0; vertical-align: top;">
                <div class="report-item-descr__content">
                    <div class="report-item-descr__text">
                        Обращаем ваше внимание,
                        что система отвечает на вопрос,
                        является тот или иной фрагмент текста заимствованным или нет.
                        Ответ на вопрос, является ли фрагмент именно плагиатом,
                        а не законной цитатой, система оставляет на ваше усмотрение.
                    </div>
                    <div class="report-item-descr__content-decor"></div>
                </div>

            </td>
        </tr>
    </table>
    <h1 class="page-title">
        Отчет о проверке № {{$report->check_unique_id}} <br>
        ({{$report->checkSystem->title}})
    </h1>
    <table style="width: 100%">
        <tr>
            <td class="report-information__item">
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
                        {{$report->data['unique']}}%
                        @if($report->data['unique'] < 50 )
                            У вашего текста низкий уровень оригинальности, мы рекомендуем вам воспользоваться услугой рерайта.
                        @elseif($report->data['unique'] < 71)
                            У вашего текста хороший уровень оригинальности.
                        @elseif($report->data['unique'] < 85)
                            Оригинальности вашего текста высокая.
                        @else
                            Поздравляем у вас отличная уникальность текста.
                        @endif
                    </div>
                </section>
                <a href="https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/report/{{$report->checkUnique->slug}}" class="report-information__link">
                    Посмотреть отчет на сайте
                </a>
            </td>
            <td class="report-information__item">
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
            </td>
        </tr>
    </table>
    <h3 class="report-information__title">Заимствования:</h3>
    <div class="report-item-links" >
        @foreach($report->data['urls'] as $item)
            <div class="report-item-links__item">
                <table style="width: 100%">
                    <tr >
                        <td class="report-item-links__percent">
                            {{$item['plagiat']  . '%'}}
                        </td>
                        <td class="report-item-links__url">
                        {{$item['url']}}
                    </tr>
                </table>
            </div>

        @endforeach
    </div>



    <div class="report-text" >
        {!! $report->highlight_text !!}
    </div>
</section>
</body>
</html>
