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
                <object :data="url" type="application/pdf" frameborder="0" width="100%" height="600px" style="padding: 20px;">
                    <embed :src="url" width="100%" height="600px"/>
                </object>




            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            url: {
                type:String
            }
        },
        data() {
            return {

            }
        }
    }
</script>
