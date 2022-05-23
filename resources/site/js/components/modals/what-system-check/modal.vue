<template>
    <div class="modal fade unique-modal" id="what_system_check"  tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered unique-modal__dialog" role="document">
            <div class="unique-modal__content what-system-check-modal__content  modal-content">
                <button  class="unique-modal__close" type="button"  data-bs-dismiss="modal" aria-label="Close">
                    <svg viewBox="0 0 41 40">
                        <use xlink:href="assets/site/images/sprites.svg?ver=44#sprite-close-gray"></use>
                    </svg>
                </button>
                <div class="what-system-check-modal__inner">
                    <h3 class="unique-modal__title">
                        Отличия систем проверки
                    </h3>
                    <ul class="what-system-check-list">
                        <item v-for="(item, index) in CheckSystems"
                            :key="index"
                            :item-data="item"
                        />
                    </ul>
                </div>
            </div>
        </div>
   </div>
</template>
<script>
import item from './components/item';
export default {
    components: {
        item
    },
    data() {
        return {
            form: {
                name: '',
                phone:'',
            },
            CheckSystems: [],
        }
    },
    methods: {
        getSystemsList() {
            axios.get('/api/check-systems')
                .then((response) => {
                    this.CheckSystems = response.data;
                })
        },
    },
    mounted() {
        this.getSystemsList();
    }
}
</script>
