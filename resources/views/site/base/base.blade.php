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
    @include('site.base._partials.modals')
    @yield('modals')
    <div class="overlay" v-if="isLoading">
        <div class="overlay__inner">
            <div class="overlay__content"><span class="spinner"></span></div>
        </div>
    </div>
</div>

@include('site.base._partials.scripts')
@yield('scripts')
</body>
</html>
