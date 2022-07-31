<template>
    <section class="report-block" v-if="loaded">
        <systems-list :selected="selectedSystems"></systems-list>
        <report  v-for="(item, index) in check_unique.reports"
            :key="item.id"
             :id="item.id"
             :check_unique="check_unique"
             v-if="loaded"
        ></report>
        <div class="report-item-descr check-unique-descr">
            <figure class="report-item-descr__icon check-unique-descr__icon">
                <img src="/assets/site/images/union.png">
            </figure>
            <div class="report-item-descr__content check-unique-descr__content">
                Обращаем ваше внимание, что система отвечает на вопрос,
                является тот или иной фрагмент текста заимствованным или нет.
                Ответ на вопрос, является ли фрагмент именно плагиатом,
                а не законной цитатой, система оставляет на ваше усмотрение.
            </div>
        </div>
        <h3 class="report-item-another-system__title">Вы можете
            <a href class="report-item-another-system__link" data-bs-toggle="modal" data-bs-target="#rewrite_modal">повысить уникальность</a>
            текста или проверить текст в другой системе</h3>
        <select-systems @selectSystem="handleSelectedSystem" :state-selected-systems="selectedSystems"></select-systems>
        <free-check-modal ref="free_check_modal"></free-check-modal>
        <PayCheckModal ref="pay_check_nodal"></PayCheckModal>
    </section>
</template>
<script>
import SystemsList from "./components/systems-list";
import Report from "./components/report";
import SelectSystems from "@/site/js/components/check-unique/components/system-list.vue"
import FreeCheckModal from "@/site/js/components/check-unique/components/FreeCheckModal";
import PayCheckModal from "@/site/js/components/check-unique/components/PayCheckModal";
    export default {
        components: {
            SystemsList, Report, SelectSystems,FreeCheckModal,PayCheckModal
        },
        props: {
            id: {
                type:Number,
            }
        },
        data() {
            return {
                loaded:false,
                selectedSystems: [],
                check_unique: {},

            }
        },
        methods: {
            getCheckUnique() {
                axios.get('/api/check-unique/' + this.id + '/show')
                    .then((response) => {
                      this.check_unique = response.data;
                      this.loaded = true;
                        this.$root.isLoading = false;
                       this.check_unique.reports.forEach((item)=> {
                           this.selectedSystems.push(item.system_id);
                       })
                    })
            },
            handleSelectedSystem(data) {
                console.log(data);
                if(data.free && data.list.length > 0) {
                    this.$refs.free_check_modal.showModal(this.check_unique, data.list);
                } else if(data.list.length > 0) {
                    this.$refs.pay_check_nodal.showModal(this.check_unique, data.list);
                }
            },

        },
        mounted() {
            this.$root.isLoading = true;
            this.getCheckUnique();

        }
    }
</script>
