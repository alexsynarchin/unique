<!DOCTYPE html>
<html lang="ru">
@include('admin.base._partials.head')
<body>
<div class="page-wrapper"  id="app" v-cloak>
    @yield('content')
        <div class="overlay" v-if="isLoading">
            <div class="overlay__inner">
                <div class="overlay__content"><span class="spinner"></span></div>
            </div>
        </div>
</div>
<script>
    window.App = {!! json_encode([
            'user' => Auth::user(),
            'signedIn' => Auth::check(),
            ]) !!} ;
</script>
@include('admin.base._partials.scripts')
@yield('scripts')
</body>
</html>
