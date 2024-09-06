<template>
    <div class="modal unique-modal" id="report_example"
         tabindex="-1" role="dialog"  aria-hidden="true" data-bs-backdrop="static">
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


            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {},
        data() {
            return {

            }
        }
    }
</script>
