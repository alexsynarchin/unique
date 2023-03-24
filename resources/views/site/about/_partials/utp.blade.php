<section class="about-utp">
    <div class="about-utp__img-wrap">
        <figure class="about-utp__img">
            <img src="{{$blocks['about-utp']['image']['link'] ?? null}}">
        </figure>

    </div>
    <div class="about-utp__content">
        <h3 class="about-utp__title">
            {{$blocks['about-utp']['title'] ?? null}}
        </h3>
        <p class="about-utp__text">
            {!! $blocks['about-utp']['description'] ?? null !!}
        </p>
    </div>

</section>
