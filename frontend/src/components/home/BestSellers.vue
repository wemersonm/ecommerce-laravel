<template>
  <HeaderSection :headerSection="headerSection" class="mb-3" :swiper="swiper" />
  <SliderCard :items="products" @swiper="onSwiper" :swiperBreakpoints="swiperBreakpoints">
    <template v-slot:item="{ slide }">
      <CardProduct :product="slide" :customClass="['d-flex justify-content-center','w-100']" />
    </template>
  </SliderCard>

</template>

<script>
import CardProduct from '../cards/CardProduct.vue';
import SliderCard from '../utils/SliderCard.vue';
import HeaderSection from '../utils/HeaderSection.vue'
export default {

  data() {
    return {
      headerSection: {
        name: "Mais Vendidos",
        title: "Produtos mais vendidos",
        showNavigation: true,
      },
      swiper: {},
      target: "BestSellers",
      products: [ // resultado do request no backend .... '-'
        {
          name: "Placa",
          newValue: 1533,
          oldValue: 1788,
        },
        {
          name: "Placa de video GIGABYTE GTX 1060 6GB",
          newValue: 849,
          oldValue: 999,
        },
        {
          name: "Memoria Ram DDR4 8gb Atermiter",
          newValue: 122,
          oldValue: 169,
        },
        {
          name: "Monitor LG 23 polegadas 60 GHZ",
          newValue: 970,
          oldValue: 1120,
        },
        {
          name: "Teclado REDRAGON Kumara k552 Switch Marrom",
          newValue: 170,
          oldValue: 209,
        },
        {
          name: "Placa Mãe Huananzhi X99 8mf LGA-2011-3 DDR4 Dual Channel",
          newValue: 460,
          oldValue: 510,
        },
        {
          name: "Mouse Gammer Razer Basilisk V3 com fio 24k dpi",
          newValue: 290,
          oldValue: 360,
        },
        {
          name: "SSD MVME M2 KingSpec 256GB",
          newValue: 170,
          oldValue: 250,
        }
      ],
      swiperBreakpoints: {
        1: {
          slidesPerView: 1,
        },
        482: {
          slidesPerView: 2,
          spaceBetween: 10,
        },
        622: {
          slidesPerView: 3,
        },
        792: {
          slidesPerView: 4,
        },
        998: {
          slidesPerView: 5,
        },
        1158: {
          slidesPerView: 6,
        },
      },
    }
  },
  methods: {
    onSwiper(swiper) {
      this.swiper = swiper;
    },

  },

  components: {
    HeaderSection,
    SliderCard,
    CardProduct
  },
}
</script>

<style lang="scss" scoped></style>