<!DOCTYPE html>
<html lang="ru">
@include('admin.base._partials.head')
<body>
<div class="page-wrapper"  id="app">
    @yield('content')

</div>
@include('admin.base._partials.scripts')
@yield('scripts')
</body>
</html>
