<section class="mp-reviews">
    <div class="container">
        <div class="mp-reviews__heading">
            <h3 class="mp-reviews__title block-title check-unique-bl__title">
                {{$blocks['mp-reviews']['title'] ?? null}}
            </h3>
            <div class="mp-reviews__controls">
                <figure class="mp-reviews-control">
                    <svg class="mp-reviews-control__icon" viewBox="0 0 13 13">
                        <use xlink:href="assets/site/images/sprites.svg?ver=15#sprite-arrow-left"></use>
                    </svg>
                </figure>
                <figure class="mp-reviews-control">
                    <svg class="mp-reviews-control__icon" viewBox="0 0 13 13">
                        <use xlink:href="assets/site/images/sprites.svg?ver=15#sprite-arrow-right"></use>
                    </svg>
                </figure>

            </div>
        </div>
        @if(($lists['mp-reviews-list'] ?? null) && count($lists['mp-reviews-list']) > 0)
            <div class="mp-reviews-list owl-carousel owl-theme">
                @foreach($lists['mp-reviews-list'] as $item)
                    <div class="mp-reviews-list__item">
                        <h3 class="mp-reviews-list__title">
                            {{$item['title'] ?? null}}
                        </h3>
                        <div class="mp-reviews-list__text">
                            {{$item['description'] ?? null}}
                        </div>
                        <div class="mp-reviews-list__bottom">
                            <span class="mp-reviews-list__name">
                                {{$item['name'] ?? null}}
                            </span>
                            <span class="mp-reviews-list__date">
                                {{$item['date'] ?? null}}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>
