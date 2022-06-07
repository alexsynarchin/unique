<template>
    <price-list-item-form
        :action_type="action_type"
        :action_url="action_url"
        :form="item.data"
        :index = "item.index"
        @submit="submitForm"></price-list-item-form>
</template>
<script>
import PriceListItemForm from "./components/PriceListItemForm";
    export default {
        components: {
            PriceListItemForm,
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
