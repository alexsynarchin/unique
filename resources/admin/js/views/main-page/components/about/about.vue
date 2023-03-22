<template>
    <section class="page-block">
        <el-form ref="form" class="mb-3">
            <div class="row">
                <el-form-item label="Заголовок" class="col-md-6">
                    <el-input v-model="form.title"></el-input>
                </el-form-item>
            </div>

            <el-form-item label="Описание">
                <tinymce v-if="form.description" v-model="form.description"/>
            </el-form-item>
            <div class="mt-3">
                <el-button type="success" @click.prevent = "submitForm">Сохранить</el-button>
            </div>
        </el-form>
        <about-list class="mb-3"></about-list>
        <about-gallery></about-gallery>
    </section>
</template>
<script>
import AboutList from "./about-list/AboutList";
import AboutGallery from "./about-gallery/AboutGallery";
import Tinymce from '@/admin/js/components/TinymceSmall';
export default {
    components: {
     AboutList,AboutGallery, Tinymce ,
    },
    data() {
        return {
            block: {},
            type: 'mp-about',
            form: {
                title: "",
                description: "",
                list_title:"",
            }
        }
    },
    methods: {
        submitForm() {
            axios.put('/api/admin/content-block/' + this.block.id + '/update', this.form)
                .then((response) => {
                    this.$notify({
                        title: 'Блок сохранен',
                        type: 'success'
                    });
                })
                .catch((error) => {

                })
        },
        getBlock() {
            axios.get('/api/admin/content-block/' + this.type)
                .then((response) => {
                    this.block = response.data;
                    for (var key in this.form) {
                        console.log(key);
                        if(this.block.content[key]) {
                            this.form[key] = this.block.content[key];
                        }
                    }
                })
                .catch((error) => {
                    console.log(error);
                })
        }
    },
    async mounted() {
        await this.getBlock();
    },
}
</script>
