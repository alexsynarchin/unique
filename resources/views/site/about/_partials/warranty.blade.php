<section class="about-warranty">
    <h3 class="block-title">
       {{$blocks['about-guarantees']['title'] ?? null}}
    </h3>
    <div class="row">
        <div class="col-lg-4">
            @if($lists['about-guarantees-list'] ?? null)
                <ul class="about-warranty-list">
                    @foreach($lists['about-guarantees-list'] as $item)
                        <li class="about-warranty-list__item">
                            {{$item['text'] ?? null}}
                        </li>
                    @endforeach
                </ul>
            @endif

        </div>
        <div class="col-lg-8">
            <about-video :video_id=" {{json_encode($blocks['about-guarantees']['youtube_link'] ?? null)}}"></about-video>
        </div>
    </div>
</section>
