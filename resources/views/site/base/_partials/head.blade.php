<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{mix('css/app.css', 'assets/site')}}?ver=19" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="{{URL::asset('assets/site/images/favicon.png')}}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token()}}" />
    <meta name="description" content="Бесплатная проверка уникальности текста. Все системы в одном месте">
    <title>Проверка уникальности</title>
    <meta property="og:title" content="Проверка-уникальности.рф" />
    <meta property="og:description" content="Бесплатная проверка уникальности текста. Все системы в одном месте">
    <meta name="og:image" content="https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/assets/site/images/favicon.png">
    <meta property="vk:image"  content="https://xn----8sbempbojoebkbodzijk2phe.xn--p1ai/assets/site/images/favicon.png" />
    <meta name="yandex-verification" content="ac1eeab5f2d97b5c" />
    <script  src='//vk.com/js/api/openapi.js' type='text/javascript'></script>
    @yield('head')
</head>
