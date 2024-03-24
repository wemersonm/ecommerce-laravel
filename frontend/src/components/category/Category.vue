<template>
  <HeaderSection :headerSection="headerSection" class="mb-3" :swiper="swiper" />
  <SliderCard :items="categories" :swiperBreakpoints="swiperBreakpoints" @swiper="onSwiper">
    <template v-slot:item="{ slide }">
      <CardCategory :category="slide" class="d-flex justify-content-center" />
    </template>
  </SliderCard>

  <HorizontalBar class="my-5 " />
</template>

<script>
import HorizontalBar from '../utils/HorizontalBar.vue';
import HeaderSection from '../utils/HeaderSection.vue';
import SliderCard from '../product/SliderCard.vue';
import CardCategory from './CardCategory.vue';
export default {

  data() {
    return {
      headerSection: {
        name: "Categorias",
        title: "Todas as Categorias",
        showNavigation: true,
      },
      swiper: {},
      categories: [
        { path: 'https://via.placeholder.com/100/f1290', name: 'Placa de Video' },
        { path: 'https://via.placeholder.com/100/f1290', name: 'Placa Mãe' },
        { path: 'https://via.placeholder.com/100/f1290', name: 'Processadores' },
        { path: 'https://via.placeholder.com/100/f1290', name: 'Memoria RAM' },
        { path: 'https://via.placeholder.com/100/f1290', name: 'Monitores' },
        { path: 'https://via.placeholder.com/100/f1290', name: 'Fonte de Alimentação' },
        { path: 'https://via.placeholder.com/100/f1290', name: 'Mouse' },
        { path: 'https://via.placeholder.com/100/f1290', name: 'Teclados' },
        { path: 'https://via.placeholder.com/100/f1290', name: 'Coolers' },
        { path: 'https://via.placeholder.com/100/f1290', name: 'Fones' },
        { path: 'https://via.placeholder.com/100/f1290', name: 'Celulares' },
        { path: 'https://via.placeholder.com/100/f1290', name: 'Notebooks' },
        { path: 'https://via.placeholder.com/100/f1290', name: 'Câmeras' },
        { path: 'https://via.placeholder.com/100/f1290', name: 'Smarthwatch' },
      ],
      swiperBreakpoints: {
        1: {
          slidesPerView: 1,
        },
        391: {
          slidesPerView: 2,
        },
        576: {
          slidesPerView: 3,
        },
        768: {
          slidesPerView: 4,
        },
        992: {
          slidesPerView: 5,
        },
        1200: {
          slidesPerView: 6,
        },
        1201: {
          slidesPerView: 7,
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
    HorizontalBar,
    CardCategory,
    SliderCard,
  },
}
</script>

<style lang="scss" scoped>
.responsive-font {
  font-size: calc(15px + 1vw);
}
</style>