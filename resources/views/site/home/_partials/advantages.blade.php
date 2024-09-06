<div class="container">
    @if($lists['mp-ratings'] ?? null)
    <ul class="mp-advantages">
        @foreach($lists['mp-ratings'] as $item)
            <li class="mp-advantages__item col-md-3">
                <section class="mp-advantages__icon-wrap">
                    <figure class="mp-advantages__icon">
                      <img src="{{$item['image']['link']}}" loading="lazy">
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
</div>

