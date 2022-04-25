<template>
    <section class="faq-item">
        <div class="faq-item__question" @click.prevent="handleAnswer">
            <h3 class="faq-item__question-text"><slot name="question"></slot></h3>
            <figure class="faq-item__question-icon">
                <svg viewBox="0 0 15 15" v-if="AnswerVisible">
                    <use xlink:href="/assets/site/images/sprites.svg?ver=15#sprite-minus"></use>
                </svg>
                <svg viewBox="0 0 15 15" v-else>
                    <use xlink:href="/assets/site/images/sprites.svg?ver=15#sprite-plus"></use>
                </svg>
            </figure>
        </div>
        <div class="faq-item__answer"
            :class="{
            'faq-item__answer--open':AnswerVisible
            }"
        >
            <slot name="answer"></slot>
        </div>
    </section>
</template>
<script>
export default {
    data() {
        return {
            AnswerVisible:false,
        }
    },
     methods: {
        handleAnswer() {
          this.AnswerVisible = !this.AnswerVisible;
        },
     }
}
</script>
