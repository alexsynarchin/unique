<template>
    <page-form
        :form="form"
        :formAction="formAction"
        @closeModal="closeModal"
    ></page-form>
</template>
<script>
import form from "./components/form";
export default {
    components:{
        'PageForm':form,
    },
    data() {
        return {
            form:{
                title:'',
                slug:'',
                banner:false,
                published:true,
                content:{},
                seo:{},
            },
            formAction: {
                url: '/api/admin/static-page',
                method: 'post',
            },
        }
    },
    methods:{
        closeModal(value) {
            this.$emit('closeModal',value)
        }
    }
}
</script>
