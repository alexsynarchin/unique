<section class="mp-faq">
    <div class="container">
        <h3 class="mp-faq__title block-title check-unique-bl__title">
            {{$blocks['mp-faq']['title'] ?? null}}
        </h3>
        <div class="row">
            <div class="col-lg-7">
                @if($lists['mp-faq-list'] ?? null)
                <mp-faq :list="{{json_encode($lists['mp-faq-list'])}} "></mp-faq>
                @endif
            </div>
            <div class="col-lg-5">
                <figure class="mp-faq__img">
                    <img src="/assets/site/images/mp/mp-faq.png" loading="lazy">
                    <div class="mp-faq__smile-1">
                        <img src="/assets/site/images/mp/mp-faq-smile-1.png" loading="lazy">
                    </div>
                    <div class="mp-faq__smile-2">
                        <img src="/assets/site/images/mp/mp-faq-smile-2.png" loading="lazy">
                    </div>
                </figure>
            </div>
        </div>
    </div>
</section>
