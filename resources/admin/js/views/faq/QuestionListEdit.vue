<template>
    <question-list-form
        :action_type="action_type"
        :action_url="action_url"
        :form="item.data"
        :index = "item.index"
        @submit="submitForm"></question-list-form>
</template>
<script>
import QuestionListForm from "./components/QuestionListForm";
    export default {
        components: {
            QuestionListForm,
        },
        props: {
            id: {
                type:Number
            },
            item: {
                type: Object
            }
        },
        data() {
            return {
                action_type:'put',
                action_url:  '/api/admin/block-lists/'+ this.id +'/edit-item',

            }
        },
        methods: {
            submitForm(data){

                this.$emit('edit', data);
            }
        },
    }
</script>
