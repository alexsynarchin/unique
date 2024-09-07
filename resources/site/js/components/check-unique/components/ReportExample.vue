<template>
    <div class="modal unique-modal" id="report_example"
         tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered unique-modal__dialog" role="document">
            <div class="unique-modal__content modal-content">
                <button  class="unique-modal__close" type="button"  data-bs-dismiss="modal" aria-label="Close">
                    <svg viewBox="0 0 41 40">
                        <use xlink:href="assets/site/images/sprites.svg?ver=44#sprite-close-gray"></use>
                    </svg>
                </button>
                <h3 class="unique-modal__title">
                    Пример отчета
                </h3>
                <vue-pdf-embed
                    ref="pdfRef"
                    :page="page"
                    @rendered="handleDocumentRender"
                    :source="url" />
            </div>
        </div>
    </div>
</template>
<script>
import VuePdfEmbed from 'vue-pdf-embed/dist/vue2-pdf-embed'
    export default {
    components: {
        VuePdfEmbed
    },
        watch: {
            showAllPages() {
                this.page = this.showAllPages ? null : 1
            },
        },
        props: {
            url: {
                type:String
            }
        },
        data() {
            return {
                isLoading: true,
                page: null,
                pageCount: 1,
                showAllPages: true,
            }
        },
        methods: {
            handleDocumentRender() {
                this.isLoading = false
                this.pageCount = this.$refs.pdfRef.pageCount
            },
        }

    }
</script>
