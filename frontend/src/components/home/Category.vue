<template>
  <HeaderSection :headerSection="headerSection" class="mb-3" :swiper="swiper" />
  <SliderCard :items="categories" :swiperBreakpoints="swiperBreakpoints" @swiper="onSwiper">
    <template v-slot:item="{ slide }">
      <CardCategory :category="slide" class="d-flex justify-content-center"/>
    </template>
  </SliderCard>
  <ButtonLink href="/flash-sales" title="Ver Todas Categorias" class="my-4 my-md-5"></ButtonLink>
  <HorizontalBar />
</template>

<script>
import HorizontalBar from '../utils/HorizontalBar.vue';
import HeaderSection from '../utils/HeaderSection.vue';
import SliderCard from '../utils/SliderCard.vue';
import CardCategory from '../cards/CardCategory.vue';
import ButtonLink from '../utils/ButtonLink.vue';
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
        { path: 'https://via.placeholder.com/100/f1290', name: 'Fonte de Alimentação Fonte de Alimentação Fonte de Alimentação' },
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
        372: {
          slidesPerView: 2,
        },
        472: {
          slidesPerView: 3,
        },
        632: {
          slidesPerView: 4,
        },
        752: {
          slidesPerView: 5,
        },
        932: {
          slidesPerView: 6,
        },
        1062: {
          slidesPerView: 7,
        },
        1228: {
          slidesPerView: 8,
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
    ButtonLink
  },
}
</script>

<style lang="scss" scoped>
.responsive-font {
  font-size: calc(15px + 1vw);
}
</style>