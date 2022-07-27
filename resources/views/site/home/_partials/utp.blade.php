<div class="container">
    <section class="mp-utp">
        <div class="mp-utp__row">
            <div class="mp-utp__img order-md-1">
                <figure class="mp-utp__fig mp-utp__fig--img">
                    <img src="{{$blocks['mp-utp']['image']['link']}}">
                </figure>
                <figure class="mp-utp__fig mp-utp__link" data-bs-toggle="modal" data-bs-target="#video_modal">
                    Cмотреть видео
                </figure>
            </div>
            <div class="mp-utp__content">
                <h1 class="mp-utp__title">
                    {{$blocks['mp-utp']['title']}}
                </h1>
                <p class="mp-utp__text">
                    {{$blocks['mp-utp']['description']}}
                </p>
                <button class="button btn" v-scroll-to="'#check_unique'">
                    Проверить уникальность текста
                </button>
            </div>
        </div>
    </section>
    <video-modal link="{{$blocks['mp-utp']['youtube_link'] ?? ''}}"></video-modal>
</div>
