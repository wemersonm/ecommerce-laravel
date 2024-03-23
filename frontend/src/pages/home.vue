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
        <OfferBanner :offerBanner="dataOfferBanner" />
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
import Categories from '../components/category/Category.vue';
import Default from '../layouts/default.vue';
import Departaments from '../components/home/departaments/Departaments.vue';
import Banner from '../components/carousel/CarouselBanner.vue';
import FlashSales from '../components/flash-sales/FlashSales.vue';
import BestSellers from '../components/best-sellers/BestSellers.vue';
import OfferBanner from '../components/offer-banner/OfferBanner.vue';
import OurProducts from '../components/our-products/OurProducts.vue';
import ServiceAdvantages from '../components/home/ServiceAdvantages.vue';
import TopHomepage from '../components/home/TopHomepage.vue';

export default {
  components: {
    Default, Departaments, Banner, FlashSales, Categories,
    BestSellers,
    OfferBanner,
    OurProducts,
    ServiceAdvantages,
    TopHomepage
  },
  data() {
    return {
      dataOfferBanner: {
        src: 'https://fastly.picsum.photos/id/833/1400/500.jpg?hmac=cH9p46o3cruEIwezIHv9TQ6xq2S0WQ-oTgliO2n98BU',
        product_slug: '/product/placa-de-video-gtx-1660-6gb-zotac',
      },


    };
  },
  methods: {

  },
}
</script>

<style lang="scss" scoped></style>