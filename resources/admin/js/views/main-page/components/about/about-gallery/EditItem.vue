<template>
    <item-form
        :action_type="action_type"
        :action_url="action_url"
        :form="item.content"
        @submit="submitForm"></item-form>
</template>
<script>
import ItemForm from "./ItemForm";
export default {
    components: {
        ItemForm,
    },
    props: {
        item: {
            type: Object
        }
    },
    data() {
        return {
            action_type:'put',
            action_url:  '/api/admin/content-block/'+ this.item.id +'/update',

        }
    },
    methods: {
        submitForm(data){

            this.$emit('edit', data);
        }
    },
}
</script>
