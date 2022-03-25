<template>
    <span class="header-panel__btn" @click.prevent="togglePanel"
        :class="{
            'header-panel__btn--open':PanelOpen,
        }"
    ></span>
</template>
<script>
import { bus } from '@/site/js/services/bus.js';
export default {
    data() {
        return {
            PanelOpen:false,
        }
    },
    methods:{
      togglePanel() {
          this.PanelOpen = !this.PanelOpen;
          bus.$emit('toggle-panel', this.PanelOpen);
      },
    },
}
</script>
