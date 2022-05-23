<template>
    <li class="what-system-check-list__item">
        <figure class="what-system-check-list__logo">
            <img :src="itemData.logo">
        </figure>
        <div class="what-system-check-list__content">
            <h4 class="what-system-check-list__title">
                {{itemData.title}}
            </h4>
           <p class="what-system-check-list__descr">
                {{itemData.description}}
           </p>
        </div>
    </li>
</template>
<script>
    export default {
        props: {
            itemData: {
                type:Object,
            }
        }
    }
</script>
