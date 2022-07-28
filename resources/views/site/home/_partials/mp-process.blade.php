<section class="mp-process">
    <div class="container">
        @if($blocks['mp-process']['list_title'] ?? null)
        <h3 class="block-title mp-process__heading check-unique-bl__title">
            {{$blocks['mp-process']['list_title'] ?? null}}
            <span class="block-title__cursor"></span>
        </h3>
        @endif
        <div class="mp-process__list">
            @if($lists['mp-process-list'] ?? null)
            @foreach($lists['mp-process-list'] as $key => $item)
                    <div class="mp-process__item col-lg-4">
                        <section class="mp-process-item">
                            <span class="mp-process-item__num">
                                0{{$key + 1}}
                            </span>
                            <figure class="mp-process-item__img">
                                <img src="{{$item['image']['link'] ?? null}}">
                            </figure>
                            <h3 class="mp-process-item__title">
                                {{$item['title'] ?? null}}
                            </h3>
                            <p class="mp-process-item__text">
                                {{$item['description'] ?? null}}
                            </p>
                        </section>
                    </div>
            @endforeach
            @endif

        </div>
    </div>
</section>
