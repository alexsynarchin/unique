<template>
    <section class="reviews-filters">
        <div class="reviews-filters__item">
            <CustomSelect
                :options="['Все услуги', 'Проверка уникальности', 'Повышение уникальности']"
                :default="'go'"
                class="select"
                @input="selectType"
            />
        </div>
        <div class="reviews-filters__item reviews-filters__item--last">
            <CustomSelect
                :options="['Сначала новые', 'Сначала старые']"
                :default="'go'"
                class="select"
                @input="selectType"
            />
        </div>
    </section>
</template>
<script>
    import CustomSelect from "@/site/js/components/custom-select/select.vue"
    export default {
        components: {
            CustomSelect
        },
        methods: {
            selectType(data) {
                console.log(data)
            },
        },
    }
</script>
