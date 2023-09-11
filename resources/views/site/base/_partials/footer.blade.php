<footer class="page-footer">
    <div class="container">
        <div class="page-footer__main row">
            <div class="col-lg-4 col-xl-3 page-footer__col-1">
                <a href="/" class="logo-title">
                    <h1 class="logo-title__title">УНИКАЛЬНОСТЬ</h1> <span class="logo-title__cursor"></span>
                </a>
                <div class="footer-pay-cards">
                    <img class="footer-pay-cards__img" src="/assets/site/images/card-1.jpg">
                    <img class="footer-pay-cards__img" src="/assets/site/images/card-2.jpg">
                    <img class="footer-pay-cards__img" src="/assets/site/images/card-3.jpg">
                </div>

            </div>
            <div class="col-xl-3 page-footer__col-2">
                <a href="/#check_unique" class="btn button button--width-100 mb-4" @if(Route::current()->getName() == 'main-page') v-scroll-to="'#check_unique'"@endif>
                    Проверить уникальность
                </a>
                <button class="btn button button--width-100 button--transparent" data-bs-toggle="modal" data-bs-target="#video_modal">
                        <span class="button__text">
                            Смотреть видео о сервисе
                        </span>
                    <svg viewBox="0 0 10 10" class="button__icon">
                        <use xlink:href="/assets/site/images/sprites.svg?ver=15#sprite-arrow-dig-top"></use>
                    </svg>
                </button>
            </div>
            <div class="col-lg-5 col-xl-4 page-footer__col-3">
               <footer-nav-first></footer-nav-first>
            </div>
            <div class="col-lg-3 col-xl-2 page-footer__col-4 ">
                <section class="contact-bl page-footer__contact-bl">
                    <span class="contact-bl__phone contact-bl__phone--footer">
                   {!! Config::get('settings.common.phone_footer') !!}
                </span>
                    <a href="" class="contact-bl__btn contact-bl__btn--footer" data-bs-toggle="modal" data-bs-target="#order-call">
                        Получить консультацию
                    </a>
                </section>
                <div class="page-footer__e-mail">
                    <svg viewBox="0 0 15 12" class="page-footer__e-mail-icon">
                        <use xlink:href="/assets/site/images/sprites.svg?ver=15#sprite-envelope"></use>
                    </svg>
                    {!! Config::get('settings.common.email') !!}
                </div>
                <ul class="social-list page-footer__social-list">
                    @if(Config::get('settings.common.whatsapp_link'))
                    <li class="social-list__item">
                        <a href="https://api.whatsapp.com/send/?phone={!! Config::get('settings.common.whatsapp_link') !!}" class="social-list__link social-list__link--dark" target="_blank">
                            <svg viewBox="0 0 24 24">
                                <use xlink:href="/assets/site/images/sprites.svg?ver=15#sprite-whatsapp-wh"></use>
                            </svg>
                        </a>
                    </li>
                    @endif
                    @if(Config::get('settings.common.instagram_link'))
                    <li class="social-list__item">
                        <a href="{!! Config::get('settings.common.instagram_link') !!}" class="social-list__link social-list__link--dark" target="_blank">
                            <svg viewBox="0 0 24 24">
                                <use xlink:href="/assets/site/images/sprites.svg?ver=15#sprite-instagram-wh"></use>
                            </svg>
                        </a>
                    </li>
                    @endif
                    @if(Config::get('settings.common.vk_link'))
                    <li class="social-list__item">
                        <a href="{!! Config::get('settings.common.vk_link') !!}" class="social-list__link social-list__link--dark" target="_blank">
                            <svg viewBox="0 0 24 24">
                                <use xlink:href="/assets/site/images/sprites.svg?ver=15#sprite-vk-wh"></use>
                            </svg>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <section class="page-footer__bottom">
        <div class="container">
            <div class="row">
                <div class="page-footer__copyright col-lg-3">
                    {!! Config::get('settings.common.copyright') !!}
                </div>
                <div class="col-lg-9">
                    <footer-nav-second></footer-nav-second>
                </div>
            </div>
        </div>
    </section>
</footer>

