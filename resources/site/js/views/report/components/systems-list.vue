<template>
    <section class="report-systems-list">
        <h3 class="report-systems-list__title">
            Системы проверки:
        </h3>
        <ul class="report-systems-list__list">
            <li class="report-systems-list__item" v-for="(item , index) in list">
                <section class="report-systems-list-item" :class="{'report-systems-list-item--active':index === 0}">
                    {{item.title}}
                </section>
            </li>
        </ul>
    </section>
</template>
<script>
    export default {
        data() {
          return {
              list: [
                  {
                      title: "NASH Antiplagiat"
                  },
                  {
                      title: "NASH «Без ожидания»"
                  },
                  {
                      title: "Text.ru"
                  },
                  {
                      title: "Текстовод"
                  },
                  {
                      title: "ADVEGO"
                  },
                  {
                      title: "Antiplagiat.ВУЗ"
                  },
                  {
                      title: "Antiplagiat.ru"
                  },
                  {
                      title: "РУКОНТЕКСТ"
                  },
                  {
                      title: "ВКР ВУЗ"
                  },
              ],
          }
        },
    }
</script>
