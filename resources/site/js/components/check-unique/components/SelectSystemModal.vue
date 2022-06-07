<template>
    <section class="">
        <div class="modal fade unique-modal" id="select_system"  tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered unique-modal__dialog" role="document">
                <div class="unique-modal__content modal-content">
                    <button  class="unique-modal__close" type="button"  data-bs-dismiss="modal" aria-label="Close">
                        <svg viewBox="0 0 41 40">
                            <use xlink:href="assets/site/images/sprites.svg?ver=44#sprite-close-gray"></use>
                        </svg>
                    </button>
                    <h3 class="unique-modal__title">
                        {{item.title}}
                    </h3>
                    <div class="select-system-modal-content">
                        <figure class="select-system-modal-content__img">
                            <img :src="item.logo">
                        </figure>
                        <div class="select-system-modal-content__right">
                            <div class="select-system-modal-content__text">
                                {{item.description}}
                            </div>
                            <button class="btn button" @click="selectSystem(index)">
                                Выбрать  {{item.title}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>
<script>

    export default {
        data() {
            return {
                index:null,
                item: {},

            }
        },
        methods: {
            showSelectSystem(index, item) {
                this.index = index;
                this.item = item;
                $('#select_system').modal('show');
            },
            selectSystem(index) {
                $('#select_system').modal('hide');
                this.$emit('selectSystem', {index:index, item:this.item});
            }
        },
    }
</script>
