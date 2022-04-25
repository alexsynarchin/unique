<template>
    <section class="faq-item">
        <div class="faq-item__question">
            <h3 class="faq-item__question-text"><slot name="question"></slot></h3>
            <figure class="faq-item__question-icon">
                <svg viewBox="0 0 15 15">
                    <use xlink:href="/assets/site/images/sprites.svg?ver=15#sprite-plus"></use>
                </svg>
            </figure>

        </div>
        <div class="faq-item__answer">
            <slot name="answer"></slot>
        </div>
    </section>
</template>
<script>
export default {

}
</script>
