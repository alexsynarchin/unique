<section class="mp-about container">
    <div class="mp-about__gallery order-lg-1">
        @if($lists['mp-about-gallery'] ?? null)
            @foreach($lists['mp-about-gallery'] as $item)
                <figure class="mp-about__gallery-item">
                    <img src="{{$item['image']['link']}}">
                </figure>
            @endforeach
        @endif
        <figure class="mp-about__gallery-item">
            <img src="/assets/site/images/orange-circle.png">
        </figure>
    </div>
    <div class="mp-about__content">
        <h3 class="mp-about__title block-title">
            {{$blocks['about']['title'] ?? null}}
        </h3>
        <div class="mp-about__text">
            {{$blocks['about']['description'] ?? null}}
        </div>
        @if($lists['mp-about-list'] ?? null)
        <ul class="mp-about-list">
            @foreach($lists['mp-about-list'] as $item)
                <li class="mp-about-list__item">
                    <img src="{{$item['image']['link']}}" class="mp-about-list__icon">
                    <span class="mp-about-list__text">
                        {{$item['title']}}
                    </span>
                </li>
            @endforeach
        </ul>
        @endif
        <div class="mp-about__btns">
            <button class="btn button mp-about__btn-first">
                Узнать подробнее о гарантиях
            </button>
            <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#video_modal">
                <span>
                    Смотреть видео о сервисе
                </span>
                <svg viewBox="0 0 10 10" class="check-unique-descr__link-icon">
                    <use xlink:href="/assets/site/images/sprites.svg?ver=15#sprite-arrow-dig-top"></use>
                </svg></button>
        </div>
    </div>

</section>
