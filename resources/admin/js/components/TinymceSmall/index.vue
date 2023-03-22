<template>
    <Editor
        v-model="text"
        api-key="n5vevbezoz59y0xm5lm9351k04wpcdlod46tt4h2ilw0x2er"
        :init="{
                                height: 350,
                                plugins: '',
                                toolbar: 'undo redo | styles | bold italic alignleft aligncenter alignright alignjustify',
                                 menubar: false,
                                 language: 'ru',
                                 content_css:'/assets/admin/css/tinymce.css',

                              }"
    />
</template>
<script>
    import Editor from '@tinymce/tinymce-vue'

    export default {
        props: {
            value: {
                type: String,
                default: '',
            },
        },
        watch: {
            text() {
                this.$emit('input', this.text)
            }
        },
        data() {
            return {
                text: this.value,
            }
        },
        components: {
            Editor,
        }
    }
</script>
