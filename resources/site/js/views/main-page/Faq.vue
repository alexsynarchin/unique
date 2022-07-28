<template>
    <section>
        <accordion-list  :faqList="list"></accordion-list>
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
