<template>
    <div>
        <div class="hamburger" :class="{'is-active':isActive}"  @click="toggleClick">
            <span class="hamburger__line"></span><span class="hamburger__line"></span><span class="hamburger__line"></span>
        </div>
    </div>
</template>

<script>
export default {
  name: 'Hamburger',
  props: {
    isActive: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    toggleClick() {
      this.$emit('toggleClick');
    },
  },
};
</script>

<style lang="scss" scoped>
.hamburger {
    display: inline-block;
    left: 0;
    position: relative;
    top: 0;
    -webkit-transition: all 0.3s ease-in-out 0s;
    transition: all 0.3s ease-in-out 0s;
    width: 37px;
    z-index: 999;
    $hamburger: &;
    &:hover {
        #{$hamburger}__line {
            width: 26px;
        }
    }
    &.is-active {
        #{$hamburger}__line:nth-child(1) {
            -webkit-transform: translateY(4px) rotate(45deg);
            transform: translateY(4px) rotate(45deg);
            width: 10px;
            height: 2px;
        }
        #{$hamburger}__line:nth-child(2) {
            -webkit-transform: translateX(0px);
            transform: translateX(0px);
            width: 22px;
            height: 2px;
        }
        #{$hamburger}__line:nth-child(3) {
            -webkit-transform: translateY(-4px) rotate(-45deg);
            transform: translateY(-4px) rotate(-45deg);
            width: 10px;
            height: 2px;
        }
    }
    &__line {
        background: #593bdb;
        display: block;
        height: 2px;
        margin-top: 6px;
        margin-bottom: 6px;
        margin-left: auto;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
        &:nth-child(1) {
            margin-top: 0;
            width: 20px;
        }
        &:nth-child(2) {
            width: 26px;
        }
        &:nth-child(3) {
            width: 20px;
            margin-bottom: 0;
        }

    }
}

</style>
