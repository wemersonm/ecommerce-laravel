<template>
  <div>
    <div class="row">
      <div class="col-lg-3 p-0 mt-5 d-lg-block d-none">
        <Departaments />
      </div>
      <div class="col-1">
        <div class="d-none d-lg-block div-y"></div>
      </div>
      <div class="col-lg-8 p-0 order-first order-lg-last mt-5">
        <CarouselBanner />
      </div>
    </div>
  </div>
</template>

<script>
import Departaments from './departaments/Departaments.vue';
import CarouselBanner from '../carousel/CarouselBanner.vue';
export default {

  components: {
    CarouselBanner, Departaments
  },
  methods: {
  },
}
</script>

<style lang="scss" scoped></style>