<template>
    <Editor
        v-model="text"
        api-key="n5vevbezoz59y0xm5lm9351k04wpcdlod46tt4h2ilw0x2er"
        :init="{
                                height: 600,
                                plugins: 'lists link image table code help wordcount template',
                                toolbar: 'fontsize | undo redo | styles | bold italic alignleft aligncenter alignright alignjustify | bullist numlist outdent indent table forecolor backcolor  template',
                                font_size_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt',
                                 language: 'ru',
                                 content_css:'/assets/admin/css/tinymce.css',
                                 templates: [
                                     {
                                         title: 'Блок баннер',
                                         description: '',
                                         content: banner,
                                     },
                                      {
                                         title: 'Кнопка проверить уникальность',
                                         description: '',
                                         content: button,
                                     },
                                 ],
                                 table_background_color_map: [
                            { title: 'Gray', value: 'F0F1F6' },
                            { title: 'Orange', value: 'FF9902' },
                            { title: 'Blue', value: '366AF3' },
                          ],
                                   color_map: [
                            'F0F1F6', 'Gray',
                            'FF9902', 'Orange',
                            '366AF3', 'Blue'
                          ]
                              }"
    />
</template>
<script>
    import Editor from '@tinymce/tinymce-vue'
    import banner from "@/admin/js/components/Tinymce/banner";
    import uniqueButton from "@/admin/js/components/Tinymce/button";
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
                banner:banner,
                button:uniqueButton,
            }
        },
        components: {
            Editor,
        }
    }
</script>
