<template>
    <section class="faq-list" :class="{'faq-list--dark': className}">
        <accordion-item ref="AccordionItem" v-for="(item, index) in faqList" :key="index" @handleClick="handleClick(index)">
            <template v-slot:question>
                {{item.question}}
            </template>
            <template v-slot:answer>
                {{item.answer}}
            </template>
        </accordion-item>
    </section>
</template>
<script>
import AccordionItem from "./AccordionItem";
export default {
    props: {
        faqList: {
            type:Array,
        },
        className: {
            type:String,
            default: ''
        },
    },
    components: {
        AccordionItem,
    },
    methods: {
        handleClick(index) {
            this.$refs.AccordionItem.forEach(function (item, i) {
                item.closeItem(index)
            });
        },
    },
}
</script>
