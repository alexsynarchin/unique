@if($lists['about-ratings'] ?? null)
    <ul class="mp-advantages row">
        @foreach($lists['about-ratings'] as $item)
            <li class="mp-advantages__item col-md-3">
                <section class="mp-advantages__icon-wrap">
                    <figure class="mp-advantages__icon">
                        <img src="{{$item['image']['link']}}">
                    </figure>
                </section>
                <h4 class="mp-advantages__title">
                    {{$item['title']}}
                </h4>
                <p class="mp-advantages__text">
                    {{$item['description']}}
                </p>
            </li>
        @endforeach
    </ul>
@endif
