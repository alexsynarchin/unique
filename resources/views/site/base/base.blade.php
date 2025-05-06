<!DOCTYPE html>
<html lang="ru">
@include('site.base._partials.head')
<body >
<div class="page-wrapper"  id="app">
    <div class="page-content">
        @include('site.base._partials.header')
        @yield('content')
    </div>
    @include('site.base._partials.footer')
    <cloud-payment></cloud-payment>
    @include('site.base._partials.modals')
    @yield('modals')
    <div class="overlay" v-if="isLoading">
        <div class="overlay__inner">
            <div class="overlay__content"><span class="spinner"></span></div>
        </div>
    </div>
</div>
<!-- START Bootstrap-Cookie-Alert -->
<div class="alert  cookiealert" role="alert">
     Наш сайт использует файлы cookie и аналогичные технологии для улучшения работы сервиса, персонализации контента, анализа трафика и показа рекламы. Некоторые данные могут передаваться третьим лицам в соответствии с нашей <a href="/privacy" target="_blank">Политикой конфиденциальности.</a>
    Продолжая пользоваться сайтом, вы соглашаетесь с использованием cookie. Вы можете отключить их в настройках браузера, но это может повлиять на функциональность сервиса.


    <button type="button" class="btn btn-primary btn-sm acceptcookies">
        Принять
    </button>
</div>
<!-- END Bootstrap-Cookie-Alert -->

@include('site.base._partials.scripts')
@yield('scripts')
</body>
</html>
