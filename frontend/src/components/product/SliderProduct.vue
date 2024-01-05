<template>
  <div :id="'carousel' + target" class="carousel slide">
    <div class="carousel-inner p-1">
      <div class="carousel-item" :class="{ 'active': index === 0 }" v-for="(slide, index) in slides" :key="index">
        <div class="row row-cols-1 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-2">
          <CardProduct v-for="product in slide" :product="product" :key="product.name" class="col" :showHorizontalCard="true" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// @ts-ignore
import CardProduct from '../product/CardProduct.vue';
export default {
  props: {
    target: {
      type: String,
      default: "Example",
      required: true,
    },

    products: {
      type: Object,
      default: () => ({}),
    },

  },
  data() {
    return {
      slides: [],
      itemsPerPage: 5,
      currentPage: 0,
    };
  },
  components: {
    CardProduct,
  },
  methods: {
    createSlides() {
      this.slides = [];
      for (let i = 0; i < this.products.length; i += this.itemsPerPage) {
        this.slides.push(this.products.slice(i, i + this.itemsPerPage));
      }
    },
    itemsPerPageResponsive() {
      if (window.innerWidth < 391) {
        return 1;
      } else if (window.innerWidth < 632) {
        return 2;
      } else if (window.innerWidth < 768) {
        return 3;
      } else if (window.innerWidth < 1118) {
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