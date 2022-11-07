<template>
    <section>
        <accordion-list class="mb-3"  :faqList="list"></accordion-list>
        <a href="/faq" class="btn button">ВСЕ ВОПРОСЫ </a>
    </section>

</template>
<script>
    import AccordionList from "../../components/accordion/index";
    export default {
        props: {
            list:{},
        },
        components: {
            AccordionList,
        },
        data() {
            return {
            }
        },
    }
</script>
