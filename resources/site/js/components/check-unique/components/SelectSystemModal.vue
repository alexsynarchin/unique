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
                        Бесплатная проверка уникальности текста
                    </h3>
                    <div class="select-system-modal-content">
                        <figure class="select-system-modal-content__img">
                            <img src="/assets/site/images/mp/system-logo-1.png">
                        </figure>
                        <div class="select-system-modal-content__right">
                            <div class="select-system-modal-content__text">
                                Очень часто студенты проверяют свои курсовые, дипломные работы или рефераты в бесплатной версии (общедоступной) Антиплагиат, получив высокий процент уникальности при проверке - отправляют преподавателю такую работу. Часто студенты проверяют свои курсовые, дипломные работы
                            </div>
                            <button class="btn button" @click="selectSystem(index)">
                                Выбрать NASH Antiplagiat
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


            }
        },
        methods: {
            showSelectSystem(index) {
                this.index = index;
                $('#select_system').modal('show');
            },
            selectSystem(index) {
                $('#select_system').modal('hide');
                this.$emit('selectSystem', index);
            }
        },
    }
</script>
