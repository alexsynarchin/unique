@extends('site.base.base')
@section('content')
    <div class="container">
        <ul class="breadcrumb-list">
            <li class="breadcrumb-list__item">
                <a href="/" class="breadcrumb-list__link">
                    Главная
                </a>
            </li>
            <li class="breadcrumb-list__item">
                Cтатьи
            </li>
        </ul>
        <h1 class="page-title">
            Cтатьи
        </h1>
        <div class="row">
            <div class="col-lg-9">
                <articles></articles>
            </div>
            <div class="col-lg-3">
                <sidebar-banner></sidebar-banner>
                <figure class="" id='test'>
                    <img src="/assets/site/images/sidebar-banner.png">
                </figure>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    3
    <script type="text/javascript"> VK.init({apiId: 51553840, onlyWidgets: true}); </script>
    <script>
        //  alert('ok');
        document.getElementById('test').addEventListener('click', hClick); // ждём нажатий на кнопку
        function hClick() { // обработчик нажатия
            VK.Auth.getLoginStatus(function (res) {
                console.log(res)
            })

            //617865644
        }


    </script>
@endsection

