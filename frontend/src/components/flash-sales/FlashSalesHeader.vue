<template>
  <div class="row ">
    <div class="col-3 align-items-center ">
      <HeaderSection name="Ofertas Relâmpago" />
    </div>
    <div class="col-7 flex-grow-1 ">
      <CountDown style="font-family: 'Aclonica', sans-serif;" />
    </div>
    <div class="col-2 justify-content-end align-items-center d-none d-sm-flex">
      <div class="ms-auto d-flex gap-2">
        <i class="bi bi-arrow-left-circle fs-3" type="button" data-bs-target="#carouselExample" data-bs-slide="prev"></i>
        <i class="bi bi-arrow-right-circle fs-3" type="button" data-bs-target="#carouselExample" data-bs-slide="next"></i>
      </div>
    </div>
  </div>
</template>

<script>
// @ts-ignore
import CountDown from '../utils/CountDown.vue';
import HeaderSection from '../utils/HeaderSection.vue';
export default {
  emits: ['leftSlider', 'rightSlider'],
  components: {
    CountDown,
    HeaderSection
  },

}
</script>

<style lang="scss" scoped></style>