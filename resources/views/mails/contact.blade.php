<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Проверка уникальности</title>
    <style>
        .wrapper {
            margin: 0 auto;
            min-width: 600px;
            max-width: 1000px;
        }
        .header {
            margin-bottom: 80px;
        }
        .button {
            text-decoration: none;
            text-align: center;
            background: #366AF3;
            color:#fff;
            font-size: 24px;
            font-weight: bold;
            padding: 20px;
            display: block;
            border-radius: 120px;
            border: 3px solid #366AF3;
        }
        .button:hover {
            text-decoration: none;
        }
        .button--transparent {
            background: transparent;
            color:#366AF3;
        }
        .footer {
            background: #F0F1F6;
            padding: 25px;
        }
        img {
            max-width: 100%;
        }
    </style>
</head>
<body style="font-family: Verdana, sans-serif;">
<div class="wrapper">
    <div
        class="header"
        style="
        padding-top:25px;
        padding-bottom: 25px;
        padding-left: 40px;
        padding-right: 40px;
        background: #F0F1F6;
    ">
        <table border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0; width: 100%;">
            <tr>
                <td>
                    <h1
                        style="
        float: left;
        position: relative;
        margin: 0 20px 0 0;
        text-transform: uppercase;
        padding: 0 10px 0 0;
        line-height: 1;
        font-size: 30px;
        "
                    >Уникальность
                        <span style="
                    position: absolute;
                    right: 0;
                    top:0;
                    width: 5.5px;
                    height: 32px;
                    background-color: #366AF3;"
                        ></span>
                    </h1>
                    <span
                        style="line-height: 36px; color: #ABAFC3; font-size: 16px"
                    >Все системы проверки в одном месте</span>
                </td>
                <td style="text-align: right">
        <span
            style="
            font-size: 24px;
            font-weight: bold;
        "
        >{{$phone}}</span>
                </td>
            </tr>
        </table>
    </div>
    <h1 class="page-title" style="font-size: 40px; margin-bottom: 30px;">Уникальность документа проверена</h1>
    <table border="0" cellpadding="0" cellspacing="0" style="margin:0 0 50px 0; padding:0; font-weight: 500; font-size: 22px;">
        <tr>
            <td class="label"  style="color: #ABAFC3; padding-right: 15px; padding-bottom: 20px;">Название документа: </td>
            <td class="value" style="padding-bottom: 20px;">{{$report->checkUnique->filename}}</td>
        </tr>
        <tr>
            <td class="label"  style="color: #ABAFC3; padding-right: 15px; padding-bottom: 20px;">Система проверки: </td>
            <td class="value" style="padding-bottom: 20px;">{{$report->checkSystem->title}}</td>
        </tr>
        <tr>
            <td class="label"  style="color: #ABAFC3; padding-right: 15px; padding-bottom: 20px;">Результат проверки: </td>
            <td class="value" style="padding-bottom: 20px;">{{json_encode($report->data['unique'])}}</td>
        </tr>
    </table>
    <p style="margin-bottom: 25px; font-weight: 500; font-size: 22px;">
        У вашего текста низкий процент уникальности, мы рекомендуем вам проверить его в платных системах или воспользоваться услугой рерайта
    </p>
    <table border="0" cellpadding="0" cellspacing="0" style="margin:0 0 60px 0; padding:0; width: 100%;">
        <tr>
            <td style="padding-right: 12px; width: 50%;">
                <a href="{{route('report', $report->checkUnique->id)}}" class="button" target="_blank">
                    Просмотреть отчет
                </a>
            </td>
            <td style="padding-left: 12px; width: 50%;">
                <a href="{{route('main-page')}}" class="button button--transparent" target="_blank">
                    Проверить уникальность
                </a>
            </td>
        </tr>
    </table>
    <div style="margin-top:20px; margin-bottom: 20px;">
        <a href="https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/report/{{$report->checkUnique->slug}}#high_unique" class="button" target="_blank">
            Просмотреть отчет
        </a>
    </div>
    <table border="0" cellpadding="0" cellspacing="0" style="margin:0 0 100px 0; padding:0; width: 100%;">
        <tr>
            <td style="width: 25%; padding-right: 10px;">
                <div>
                    <img width="100px" src="https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/assets/site/images/email/adv-1.png">
                </div>
                <h4 style="font-size: 17px; margin-top: 20px; margin-bottom: 10px;">Скорость выполнения</h4>
                <p style="font-size: 15px;">
                    Получи результаты проверки уже в течение 15 минут
                </p>
            </td>
            <td style="width: 25%; padding-left: 10px; padding-right: 10px;">
                <div>
                    <img width="100px" src="https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/assets/site/images/email/adv-2.png">
                </div>
                <h4 style="font-size: 17px; margin-top: 20px; margin-bottom: 10px;">Максимальная точность</h4>
                <p style="font-size: 15px;">
                    Проверка текста по 10 самым популярным сервисам
                </p>
            </td>
            <td style="width: 25%; padding-left: 10px; padding-right: 10px;">
                <div>
                    <img width="100px" src="https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/assets/site/images/email/adv-3.png">
                </div>
                <h4 style="font-size: 17px; margin-top: 20px; margin-bottom: 10px;">Удобство и простота</h4>
                <p style="font-size: 15px;">
                    Для начала работы потребуется всего 10 секунд
                </p>
            </td>
            <td style="width: 25%; padding-left: 10px;">
                <div>
                    <img width="100px" src="https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/assets/site/images/email/adv-4.png">
                </div>
                <h4 style="font-size: 17px; margin-top: 20px; margin-bottom: 10px;">Анонимность</h4>
                <p style="font-size: 15px;">
                    Ваша работа никогда не попадет в публичный доступ.
                </p>
            </td>
        </tr>
    </table>
    <div class="footer">
        <table border="0" cellpadding="0" cellspacing="0" style="margin:0 0 0 0; padding:0; width: 100%;">
            <tr>
                <td style="width: 25%; padding-right: 5px;">
                    <img style="max-width: 100%;"  src="https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/assets/site/images/email/foot-1.png">
                </td>
                <td style="width: 25%; padding-left: 5px;padding-right: 5px">
                    <img style="max-width: 100%;"  src="https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/assets/site/images/email/foot-2.png">
                </td>
                <td style="width: 25%; padding-left: 5px; padding-right: 5px;">
                    <img style="max-width: 100%;"  src="https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/assets/site/images/email/foot-3.png">
                </td>
                <td style="width: 25%; padding-left: 5px;">
                    <img style="max-width: 100%;"  src="https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/assets/site/images/email/foot-4.png">
                </td>
            </tr>
        </table>
    </div>
    <p style="margin-top: 20px">
        Данное письмо сгенерировано автоматически. Отвечать на него не нужно. По всем вопросам пишите в службу техподдержки.
    </p>
    <div style="margin-top: 20px">
        <a href="https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/contact">
            <img src="https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/assets/site/images/consultation.jpg">
        </a>
    </div>
</div>

</body>
</html>


