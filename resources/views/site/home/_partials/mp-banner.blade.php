<div class="container">
   <section class="mp-banner">
       <figure class="mp-banner__mobile-img">
           <img src="/assets/site/images/mp/mp-banner-mobile.png" loading="lazy">
       </figure>
       <div class="mp-banner__content">
           <h3 class="mp-banner__title">
               Проверить оригинальность текста

           </h3>
           <p class="mp-banner__text">
               Бесплатная проверка уникальности и платные тарифы
           </p>
       </div>
       <div class="mp-banner__action">
           <a href="/#check_unique'" class="btn button button--white" @if(Route::current()->getName() == 'main-page') v-scroll-to="'#check_unique'"@endif>
               Проверить уникальность
           </a>
       </div>

   </section>
</div>
