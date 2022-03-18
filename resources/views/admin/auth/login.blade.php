@extends('admin.base.admin_base')
@section('content')
    <section class="auth">
        <div class="container">
            <div class="row  justify-content-center">
                <div class="col-md-4">
                    <div class="card text-center ">
                        <div class="card-header">
                            <h1 class="auth__title">
                                Проверка уникальности <br>
                                Панель администрирования
                            </h1>
                        </div>
                        <div class="card-body">
                            <admin-login></admin-login>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
