<template>
    <section style="position:relative;">
        <ckeditor :editor="editor"  v-model = 'text'  :config="editorConfig"  @input="onEditorInput"></ckeditor>
    </section>

</template>
<script>
import ClassicEditor from 'ckeditor5-karta-metrov-build/build/ckeditor';
export default {
    props:['value'],
    components:{
    },
    data(){
        return {
            text:  this.value,
            code:'',
            editor: ClassicEditor,
            HTMLVisible:false,
            editorConfig: {
                toolbar: {
                    items: [
                        'bold',
                        'italic',
                        'undo',
                        'redo'
                    ]
                },
                mediaEmbed: {
                    previewsInData: true
                },
            },
        }
    },
    methods: {
        onEditorInput() {
            this.$emit('update:value', this.text)
        },
        saveHtmlCode() {
            this.text = this.code;
            this.HTMLVisible = false;
        },
        changeHtmlCode(code) {

        },
        openModal() {
            this.code = this.text;
            this.HTMLVisible = true;
        },
    }
}
</script>
<style>
.ck-body-wrapper {
    position: relative;
    z-index: 10000;
}
</style>
