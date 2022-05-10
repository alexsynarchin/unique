<template>
    <section class="report-item">
        <h3 class="report-item__title">
            Проверка {{report.formatted_date}}
        </h3>
        <div class="report-item-system">
            <h4 class="report-item-system__title">
                NASH Antiplagiat
            </h4>
            <figure class="report-item-system__logo">
                <img src="/assets/site/images/mp/system-logo-1.png">
            </figure>
        </div>
    </section>
</template>
<script>
    export default {
        props: {
            report: {
                type:Object,
            },
        },
    }
</script>
