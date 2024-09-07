


<script src="/assets/site/js/openapi.js" defer></script>

<script type="text/javascript">
    VK.init({
        apiId: 51771782
       //apiId: 51581291
        //apiId: 51554125
    })
</script>
<script src="{{mix('js/manifest.js', 'assets/site')}}" defer></script>
<script src="{{mix('js/vendor.js','assets/site')}}" defer></script>
<script src="{{mix('js/app.js','assets/site')}}" defer></script>
@if(stripos(@$_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false && stripos(@$_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false)
<!-- Yandex.Metrika counter -->

<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(93111741, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });

</script>
@endif
<noscript><div><img src="https://mc.yandex.ru/watch/93111741" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
@if((int) Config::get('settings.common.recaptcha') === 1)
    {!!  GoogleReCaptchaV3::init() !!}
@endif


@if(Config::get('settings.common.scripts'))
    {!! Config::get('settings.common.scripts') !!}
@endif
