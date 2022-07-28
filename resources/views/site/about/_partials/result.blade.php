<section class="about-result">
           <div class="about-result__main">
            <h3 class="block-title about-result__title">
                {{$blocks['about-work-result']['title'] ?? null}}
            </h3>
            <div class="about-result__text">
                {{$blocks['about-work-result']['description'] ?? null}}
            </div>
        </div>
        <div class="about-result__list">
            @if($lists['about-work-result-list'] ?? null)
                <ul class="about-result-numbers">
                    @foreach($lists['about-work-result-list'] as $item)
                        <li class="about-result-numbers__item">
                    <span class="about-result-numbers__label">
                        {{$item['title'] ?? null}}
                    </span>
                    <span class="about-result-numbers__value">
                        {{$item['num'] ?? null}}
                    </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
</section>
