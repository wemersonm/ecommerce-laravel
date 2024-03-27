<template>
  <div>
    <HeaderSection :headerSection="headerSection" class="mb-3" :swiper="swiper">
      <template v-slot:middle >
        <CountDown />
      </template>
    </HeaderSection>
    <SliderCard :items="products" :swiperBreakpoints="swiperBreakpoints" @swiper="onSwiper">
      <template v-slot:item="{ slide }">
        <CardProduct :product="slide" :key="slide.name" class="w-100 d-flex justify-content-center" />
      </template>
    </SliderCard>
    <ButtonLink href="/flash-sales" title="Ver Todos Produtos" class="my-5"></ButtonLink>
    <HorizontalBar />
  </div>
</template>

<script>
import HeaderSection from '../utils/HeaderSection.vue';
import SliderCard from '../utils/SliderCard.vue';
import ButtonLink from '../utils/ButtonLink.vue';
import CountDown from '../utils/CountDown.vue';
import HorizontalBar from '../utils/HorizontalBar.vue';
import CardProduct from '../cards/CardProduct.vue';
export default {
  data() {
    return {
      headerSection: {
        name: "Ofertas",
        title: "Ofertas Relâmpago",
        showNavigation: true,
      },
      swiper: {},
      products: [ // request do backend ... '-'
        {
          name: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita reprehenderit odio quis amet accusamus quos. Nobis delectus placeat quo provident sit, explicabo ratione laborum quisquam inventore amet ut aliquam exercitationem.",
          newValue: 1533,
          oldValue: 1788,
        },
        {
          name: "Placa de video GIGABYTE GTX 1060 6GB",
          newValue: 849,
          oldValue: 999,
        },
        {
          name: "Memoria",
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
    };
  },
  methods: {
    onSwiper(swiper) {
      this.swiper = swiper
    },
  },
  components: {
    SliderCard, HeaderSection,
    ButtonLink,
    CountDown,
    HorizontalBar,
    CardProduct
  },

}
</script>

<style lang="scss" scoped></style>