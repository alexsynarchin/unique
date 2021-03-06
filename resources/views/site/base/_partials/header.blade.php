<header class="page-header">
    <div class="container page-header__inner">
        <a href="/" class="logo-title page-header__logo">
            <h1 class="logo-title__title">УНИКАЛЬНОСТЬ</h1> <span class="logo-title__cursor"></span>
        </a>
       <header-panel-btn></header-panel-btn>
        <section class="page-header__right">
            <a href="" class="btn button" v-scroll-to="'#check_unique'">
                Проверить уникальность
            </a>
            <ul class="social-list social-list--header">
                <li class="social-list__item">
                    <a href="https://api.whatsapp.com/send/?phone={!! Config::get('settings.whatsapp_link') !!}" class="social-list__link">
                        <svg viewBox="0 0 24 24">
                            <use xlink:href={{asset("assets/site/images/sprites.svg?ver=15#sprite-whatsapp")}}></use>
                        </svg>
                    </a>
                </li>
                <li class="social-list__item">
                    <a href="{!! Config::get('settings.instagram_link') !!}" class="social-list__link">
                        <svg viewBox="0 0 24 24">
                            <use xlink:href={{asset("assets/site/images/sprites.svg?ver=15#sprite-instagram")}}></use>
                        </svg>
                    </a>
                </li>
                <li class="social-list__item">
                    <a href="{!! Config::get('settings.vk_link') !!}" class="social-list__link">
                        <svg viewBox="0 0 24 24">
                            <use xlink:href={{asset("assets/site/images/sprites.svg?ver=15#sprite-vk")}}></use>
                        </svg>
                    </a>
                </li>
            </ul>
            <div class="page-header__contact contact-bl">
                <span class="contact-bl__phone">

                     {!! Config::get('settings.phone_header') !!}
                </span>
                <a href="" class="contact-bl__btn" data-bs-toggle="modal" data-bs-target="#order-call">
                    Получить консультацию
                </a>
            </div>
        </section>
    </div>
    <header-panel></header-panel>
</header>



