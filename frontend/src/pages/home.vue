<template>
  <Default>
    <template v-slot:main>
      <section class="container-xxl">
        <TopHomepage />
      </section>

      <section class="container-xxl mt-3 mt-md-5">
        <FlashSales />
      </section>

      <section class="container-xxl mt-3 mt-md-5">
        <Categories />
      </section>

      <section class="container-xxl mt-3 mt-md-5">
        <BestSellers />
      </section>

      <section class="container-xxl mt-3 mt-md-5">
        <OfferBanner />
      </section>

      <section class="container-xxl  mt-3 mt-md-5">
        <OurProducts />
      </section>
      <section class="container-xxl   my-3 my-md-5 ">
        <ServiceAdvantages />
      </section>
    </template>
  </Default>
</template>

<script>
import Default from '../layouts/default.vue';
import TopHomepage from '../components/home/TopHomepage.vue';
import FlashSales from '../components/home/FlashSales.vue';
import Categories from '../components/home/Category.vue';
import BestSellers from '../components/home/BestSellers.vue';
import OfferBanner from '../components/home/OfferBanner.vue';
import OurProducts from '../components/home/OurProducts.vue';
import ServiceAdvantages from '../components/home/ServiceAdvantages.vue';

export default {
  components: {
    Default, FlashSales, Categories,
    BestSellers,
    OfferBanner,
    OurProducts,
    ServiceAdvantages,
    TopHomepage
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