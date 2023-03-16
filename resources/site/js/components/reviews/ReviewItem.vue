<template>
    <div class="review-item">
        <h3 class="review-item__title">
            {{item.title}}
        </h3>
        <div class="review-item__text">
       {{item.description}}
        </div>
        <div class="review-item__bottom">
                    <span class="mp-reviews-list__name">
                        {{item.name}}
                    </span>
            <span class="review-item__date">
                         {{item.date}}
            </span>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            item: {
                type:Object
            }
        }
    }
</script>
