@extends('site.base.base')
@section('content')
    <div class=" error-404__content">
        <div class="error-404__inner container">
            <p class="error-404__text">
                К сожалению страница не существует либо она временно не доступна.
            </p>
            <div class="error-404__buttons">
                <a href="/#check_unique" class="btn button page-header__btn"
                   @if(Route::current()->getName() == 'main-page') v-scroll-to="'#check_unique'"@endif>
                    Проверить уникальность
                </a>
                <a href="/" class="btn button page-header__btn">
                    На главную
                </a>
            </div>
        </div>

    </div>
@endsection
