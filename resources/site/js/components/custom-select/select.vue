<template>
    <div
        class="custom-select"
        :tabindex="tabindex"
        @blur="open = false"
    >
        <div
            class="selected"
            :class="{open: open}"
            @click="open = !open"
        >
            {{ selected.label }}
            <svg viewBox="0 0 16 17" class="selected__icon" :class="{'selected__icon--open': open}">
                <use xlink:href="/assets/site/images/sprites.svg?ver=44#sprite-select-arrow"></use>
            </svg>
        </div>
        <div
            class="items"
            :class="{selectHide: !open}"
        >
            <div
                class="item"
                v-for="(option, i) of options"
                :key="i"
                @click="selected=option; open=false; $emit('input', {type:type, value:option.value});"
            >
                {{ option.label }}
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:{
        options:{
            type: Array,
            required: true
        },
        type: {
            type:String
        },
        tabindex:{
            type: Number,
            required: false,
            default: 0
        }
    },
    data() {
        return {
            selected: this.options.length > 0 ? this.options[0] : null,
            open: false
        };
    },
    mounted(){
        //this.$emit('input', {type:this.type, value:this.selected.value});
    }
};
</script>
<style lang="scss" scoped>

.custom-select {
    position: relative;
    width: 100%;
    text-align: left;
    outline: none;
    height: 47px;
    line-height: 47px;
}

.selected {
    background: #F0F1F6;
    border-radius: 5px;
    padding-right: 40px;
    padding-left: 8px;
    cursor: pointer;
    user-select: none;
    font-size: 17px;
    font-weight: 500;
    &__icon {
        position: absolute;
        right: 16px;
        top:50%;
        width: 16px;
        transform: translateY(-50%);
        &--open {
            transform: translateY(-50%) scaleY(-1);
        }
    }
}

.selected.open{

    border-radius: 5px 5px 0px 0px;
}


.items {
    font-size: 17px;
    font-weight: 500;
    z-index: 2;
    border-radius: 0px 0px 5px 5px;
    overflow: hidden;
    position: absolute;
    background: #E3E5ED;
    left: 0;
    right: 0;
}

.item{
    padding-left: 8px;
    cursor: pointer;
    user-select: none;
}

.item:hover{
    background: #366AF3;
    color:#fff;
}

.selectHide {
    display: none;
}
</style>
