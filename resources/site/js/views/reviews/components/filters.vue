<template>
    <section class="reviews-filters">
        <div class="reviews-filters__item">
            <CustomSelect
                :options="filterOptions"
                :type="'filter'"
                :default="'go'"
                class="select"
                @input="selectType"
            />
        </div>
        <div class="reviews-filters__item reviews-filters__item--last">
            <CustomSelect
                :options="sortOptions"
                :default="'go'"
                :type="'sort'"
                class="select"
                @input="selectType"
            />
        </div>
    </section>
</template>
<script>
    import { bus } from '@/site/js/services/bus.js';
    import CustomSelect from "@/site/js/components/custom-select/select.vue"
    export default {
        components: {
            CustomSelect
        },
        data() {
            return {
                filterOptions: [
                    {
                        label: 'Все услуги',
                        value: "all",
                    },
                    {
                        label: 'Проверка уникальности',
                        value: "check_unique",
                    },
                    {
                        label: 'Повышение уникальности',
                        value: "up_unique",
                    },
                ],
                sortOptions: [
                    {
                        label: 'Сначала новые',
                        value: 'desc'
                    },
                    {
                        label: 'Сначала старые',
                        value: 'asc'
                    }
                ]
            }
        },
        methods: {
            selectType(data) {

                bus.$emit('reviews-filters', data);
            },
        },
    }
</script>
