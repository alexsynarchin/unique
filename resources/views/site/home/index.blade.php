@extends('site.base.base')
@section('content')
    @include('site.home._partials.utp')
    @include('site.home._partials.advantages')
    <div class="container">
        <check-unique></check-unique>
    </div>
    @include('site.home._partials.why')
    @include('site.home._partials.mp-process')
@endsection
