<template>
  <Default>
    <template v-slot:main>
      <section class="container-xxl">
        <TopHomepage />
      </section>

      <section class="container-xxl mt-5">
        <FlashSales />
      </section>

      <section class="container-xxl mt-5">
        <Categories />
      </section>

      <section class="container-xxl mt-5">
        <BestSellers />
      </section>

      <section class="container-xxl my-5">
        <OfferBanner  />
      </section>

      <section class="container-xxl my-5">
        <OurProducts />
      </section>
      <section class="container-xxl my-5">
        <ServiceAdvantages />
      </section>
    </template>
  </Default>
</template>

<script>
import Default from '../layouts/default.vue';
import TopHomepage from '../components/home/TopHomepage.vue';
import FlashSales from '../components/flash-sales/FlashSales.vue';
import Categories from '../components/category/Category.vue';
import BestSellers from '../components/best-sellers/BestSellers.vue';
import OfferBanner from '../components/offer-banner/OfferBanner.vue';
import OurProducts from '../components/our-products/OurProducts.vue';
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