

<script src="/assets/site/js/openapi.js"></script>
<script type="text/javascript">

    function uncheck()

    {

        forms=document.getElementsByTagName("form");

        for(i=0;i<forms.length;i++){
            for(x=0;x<forms[i].elements.length;x++){
                if(forms[i].elements[x].checked == true)
                    forms[i].elements[x].value == false;
            }
        }
        return true;
    }

    window.onload=uncheck;
</script>
<script type="text/javascript">
    VK.init({
       apiId: 51581291
        //apiId: 51554125
    })
</script>
<script src="{{mix('js/app.js','assets/site')}}"></script>
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
<noscript><div><img src="https://mc.yandex.ru/watch/93111741" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
@if((int) Config::get('settings.common.recaptcha') === 1)
    {!!  GoogleReCaptchaV3::init() !!}
@endif

