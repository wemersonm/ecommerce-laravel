<template>
  <div class="row">
    <div class="col-3 align-items-center">
      <span class="responsive-font">Ofertas Relâmpago</span>
    </div>
    <div class="col-7 flex-grow-1 ">
      <CountDown style="font-family: 'Aclonica', sans-serif;" />
    </div>
    <div class="col-2 d-flex gap-2 justify-content-end">
      <i class="bi bi-arrow-left-circle fs-3" @click="$emit('leftSlider')"></i>
      <i class="bi bi-arrow-right-circle fs-3" @click="$emit('rightSlider')"></i>
    </div>
  </div>
</template>

<script>
// @ts-ignore
import CountDown from '../utils/CountDown.vue';
export default {
  emits: ['leftSlider', 'rightSlider'],
  components: {
    CountDown,
  },

}
</script>

<style lang="scss" scoped>
.responsive-font {
  font-size: calc(12px + 0.7vw);
}
</style>