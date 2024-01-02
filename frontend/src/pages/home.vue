<template>
  <Default>
    <template #main>
      <section class="container-xl container-fluid">
        <div class="row">
          <div class="col-lg-3 p-0 mt-5 d-lg-block d-none">
            <Departaments />
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

      <section class="container-xl container-fluid mt-5">
        <Categories />
      </section>

      <section class="container-xl container-fluid mt-5">
        <BestSellers />
      </section>

      <section class="container-xl container-fluid my-5">
        <OfferBanner :offerBanner="dataOfferBanner" />
      </section>
    </template>
  </Default>
</template>

<script>
import Categories from '../components/category/Category.vue';
// @ts-ignore
import Default from '../layouts/default.vue';
import Departaments from '../components/home/departaments/Departaments.vue';
import Banner from '../components/carousel/CarouselBanner.vue';
// @ts-ignore
import FlashSales from '../components/flash-sales/FlashSales.vue';
import BestSellers from '../components/best-sellers/BestSellers.vue';
import OfferBanner from '../components/offer-banner/OfferBanner.vue';

export default {
  components: {
    Default, Departaments, Banner, FlashSales, Categories,
    BestSellers,
    OfferBanner
  },
  data() {
    return {
      dataOfferBanner: {
        src: 'https://fastly.picsum.photos/id/833/1400/500.jpg?hmac=cH9p46o3cruEIwezIHv9TQ6xq2S0WQ-oTgliO2n98BU',
        product_slug: '/product/placa-de-video-gtx-1660-6gb-zotac',
      }
    };
  },
  methods: {

  },
}
</script>

<style lang="scss" scoped></style>