<template>
    <section class="mb-3">
        <el-divider></el-divider>

        <div class="row">

            <div class="col-md-9 d-flex align-items-center">
                <i style="font-size: 22px" class="el-icon-rank building-option-value-item__handle"></i>

                <div>
                    <h4>{{data.question}}</h4>
                    <p> {{data.answer}}</p>
                </div>
            </div>
            <div class="col-md-3">
                <el-button type="primary" icon="el-icon-edit" @click.prevent="editItem"></el-button>
                <el-button type="danger" icon="el-icon-delete" @click.prevent="deleteItem"></el-button>
            </div>
        </div>



    </section>
</template>
<script>
export default {
    props: {
        data:{
            type:Object,
        },
    },
    methods: {
        editItem() {
            this.$emit('editListItem', {index: this.$vnode.key, data:this.data})
        },
        deleteItem() {
            this.$emit('deleteListItem', this.$vnode.key)
        },
    }
}
</script>

