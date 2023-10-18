<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{mix('css/app.css', 'assets/site')}}?ver=19" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="{{URL::asset('assets/site/images/favicon.png')}}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token()}}" />
    <title>@if(isset($seo['title'])){{$seo['title']?$seo['title']:$mp_seo -> title}}@else{{$mp_seo -> title}}@endif</title>
    <meta name="description" content="@if(isset($seo['description'])){{$seo['description']?$seo['description']:$mp_seo -> description}}@else{{$mp_seo -> description}}@endif"/>
    <meta name="keywords" content="@if(isset($seo['keywords'])){{$seo['keywords']?$seo['keywords']:$mp_seo -> keywords}}@else{{$mp_seo -> keywords}}@endif"/>
    <meta property="og:title" content="{!! Config::get('settings.repost.title') !!}" />
    <meta property="og:description" content="{!! Config::get('settings.repost.repost_text') !!}">
    <meta name="og:image" content="{!! Config::get('settings.repost.image') !!}">
    <meta property="vk:image"  content="{!! Config::get('settings.repost.image') !!}" />
    <meta name="yandex-verification" content="ac1eeab5f2d97b5c" />
    @yield('head')
</head>
