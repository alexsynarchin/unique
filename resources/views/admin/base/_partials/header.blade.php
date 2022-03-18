<header  class="page-header container-fluid">
    <div class="row h-100">
        <div class="col-md-6">

        </div>
        <div class="col-md-6 page-header__right">
            <header-profile
            :user="{{json_encode(Auth::user())}}"
            ></header-profile>
        </div>
    </div>
</header>
