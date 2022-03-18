<template>
    <li class="building-option-value-item">

        <section class="building-option-value-item__show" >
            <h5 class="building-option-value-item__name">   <i class="el-icon-rank building-option-value-item__handle"></i> {{item.title}} </h5>
            <section class="building-option-value-item__actions">
                <el-button type="primary" icon="el-icon-edit" size="small" @click.prevent="editItem"></el-button>
                <el-button class="ml-1" type="danger" icon="el-icon-delete" size="small" @click.prevent="deleteItem"></el-button>
            </section>
        </section>
    </li>
</template>
<script>
    export default {
        props:['item','index'],
        data() {
            return {

            }
        },
        methods: {
            editItem() {

                this.$emit('editItem', this.item);
            },


            deleteItem() {
                axios.post('/api/admin/menu/' + this.item.id + '/remove' )
                    .then((response) => {
                        this.$emit('deleteItem')
                    })
                    .catch((error) => {

                    });

            },
        },
    }
</script>
