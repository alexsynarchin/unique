<section class="mp-why">
    <div class="mp-why__inner container">
        <div class="mp-why__image-wrap order-lg-1">
            <figure class="mp-why__image ">
                <img src="/assets/site/images/mp/mp-why.png">
                <div class="mp-why__dec-1">
                    <img src="/assets/site/images/mp/mp-why-dec-1.png">
                </div>
                <div class="mp-why__dec-2">
                    <img src="/assets/site/images/mp/mp-why-dec-2.png">
                </div>
            </figure>
        </div>

        <div class="mp-why__content">
            <h3 class="block-title check-unique-bl__title">
               {{$blocks['mp-why']['title'] ?? null}}
                <span class="block-title__cursor"></span>
            </h3>
            <div class="mp-why__text">
                {!! $blocks['mp-why']['description'] ?? null !!}
            </div>
            <div class="mp-why__image-wrap mp-why__image-wrap--mobile">
                <figure class="mp-why__image ">
                    <img src="/assets/site/images/mp/mp-why.png">
                    <div class="mp-why__dec-1">
                        <img src="/assets/site/images/mp/mp-why-dec-1.png">
                    </div>
                    <div class="mp-why__dec-2">
                        <img src="/assets/site/images/mp/mp-why-dec-2.png">
                    </div>
                </figure>
            </div>
            <h3 class="mp-why-list__heading">
                {{$blocks['mp-why']['list_title'] ?? null}}
            </h3>
            @if($lists['mp-why-list'] ?? null)
                <ul class="mp-why-list">
                    @foreach($lists['mp-why-list'] as $item)
                        <li class="mp-why-list__item">
                            <span class="mp-why-list__per-value">
                                {{$item['unique_percent']['label'] ?? null}}
                            </span>
                            <figure class="mp-why-list__per-line mp-why-list__per-line--{{$item['unique_percent']['num'] ?? null}}"></figure>
                            <h4 class="mp-why-list__title">
                                {{$item['title']}}
                            </h4>
                            <p class="mp-why-list__text">
                                {{$item['description']}}
                            </p>
                        </li>
                    @endforeach
                </ul>

            @endif

        </div>
    </div>


</section>
