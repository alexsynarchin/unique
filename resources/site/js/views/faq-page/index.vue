<template>
    <accordion-list class-name="faq-list--dark"  :faq-list="faqList[0]['list']"></accordion-list>
</template>
<script>
import AccordionList from "../../components/accordion/index";
export default {
    components: {
        AccordionList,
    },
    data() {
        return {
            faqList: [],
        }
    },
    methods: {
        getList() {
            axios.get('/api/block-list/faq')
                .then((response) => {
                    this.faqList = response.data;
                })
        }
    },
    mounted() {
        this.getList();
    }
}
</script>
