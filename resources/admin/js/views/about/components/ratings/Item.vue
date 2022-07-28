<template>
    <section class="mb-3">
        <el-divider></el-divider>
        <div class="row">
            <div class="col-md-9 d-flex align-items-center">
                <i style="font-size: 22px" class="el-icon-rank building-option-value-item__handle"></i>
                <el-image
                    style="width: 100px; margin-left: 10px; margin-right: 25px;background: blue; padding: 20px"
                    :src="data.content.image.link"
                    fit="contain"></el-image>
                <div>
                    <h4>{{data.content.title}}</h4>
                    <p> {{data.content.description}}</p>
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
            this.$emit('editItem', {index: this.$vnode.key, data:this.data})
        },
        deleteItem() {
            axios.delete('/api/admin/content-block/' + this.data.id + '/delete')
                .then((response) => {
                    this.$emit('deleteItem', this.$vnode.key)
                })
        },
    }
}
</script>

