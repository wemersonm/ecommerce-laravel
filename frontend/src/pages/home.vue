<template>
  <Default>
    <template #main>
      <section class="container-xl container-fluid">
        <div class="row">
          <div class="col-lg-3 p-0 mt-5 d-lg-block d-none">
            <Categories />
          </div>
          <div class="col-1">
            <div class="d-none d-lg-block div-y"></div>
          </div>
          <div class="col-lg-8 p-0 order-first order-lg-last mt-5">
            <Banner />
          </div>
        </div>
      </section>


      <section class="container-xl container-fluid mt-5">
        <FlashSales />
      </section>
    </template>
  </Default>
</template>

<script>
import Default from '../layouts/default.vue';
import Categories from '../components/home/categories/Categories.vue';
// @ts-ignore
import Banner from '../components/home/carousel/CarouselBanner.vue';
import FlashSales from '../components/flash-sales/FlashSales.vue';
// import { useAuthStore } from '../stores/auth';

export default {
  components: {
    Default, Categories, Banner, FlashSales,
  },
  data() {
    return {

    };
  },
  methods: {

  },
}
</script>

<style lang="scss" scoped></style>