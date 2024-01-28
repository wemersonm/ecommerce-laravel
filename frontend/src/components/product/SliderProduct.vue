<template>
  <Slider :slides="products" :slidesPerView="itemsPerPage" :spaceBetween="10">
    <template v-slot:slide="{ slide }">
      <CardProduct :product="slide" :showHorizontalCard="showHorizontalCard" :key="slide.name" />
    </template>
  </Slider>
</template>

<script>
// @ts-ignore
import CardProduct from '../product/CardProduct.vue';
import Slider from '../utils/Slider.vue';
export default {
  props: {
    products: {
      type: Object,
      default: () => ({}),
    },
    showHorizontalCard: {
      type: Boolean,
      default: false,
    },

  },
  data() {
    return {
      slides: [],
      itemsPerPage: 5,
    };
  },
  components: {
    CardProduct,
    Slider
  },
  methods: {
    createSlides() {
      this.slides = [];
      for (let i = 0; i < this.products.length; i += this.itemsPerPage) {
        this.slides.push(this.products.slice(i, i + this.itemsPerPage));
      }
    },

    itemsPerPageResponsive() {
      if (window.innerWidth < 576) {
        return 1;
      } else if (window.innerWidth < 682) {
        return 2;
      } else if (window.innerWidth < 923) {
        return 3;
      } else if (window.innerWidth < 1200) {
        return 4;
      } else {
        return 5;
      }
    },
    handlerResize() {
      this.itemsPerPage = this.itemsPerPageResponsive();
      this.createSlides();
    }
  },
  created() {
    this.itemsPerPage = this.itemsPerPageResponsive();
    this.createSlides();
    window.addEventListener('resize', this.handlerResize);
  },

  destroyed() {
    window.removeEventListener('resize', this.handleResize);
  },
};
</script>

<style lang="scss" scoped></style>