<template>
    <Editor
        v-model="text"
        api-key="n5vevbezoz59y0xm5lm9351k04wpcdlod46tt4h2ilw0x2er"
        :init="tinySettings"
    />
</template>
<script>
    import Editor from '@tinymce/tinymce-vue'
    import tinySettings from "@/admin/js/components/Tinymce/tinySettings";

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

                tinySettings:tinySettings
            }
        },
        components: {
            Editor,
        }
    }
</script>
