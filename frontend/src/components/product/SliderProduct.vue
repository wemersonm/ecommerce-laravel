<template>
  <div :id="'carousel' + target" class="carousel slide">
    <div class="carousel-inner p-1">

      <div class="carousel-item" :class="{ 'active': index === 0 }" v-for="(slide, index) in  slides " :key="index">
        <div class="row m-0 p-0" :class="row">
          <CardProduct v-for=" product  in  slide " :product="product" :showHorizontalCard="showHorizontalCard"
            :key="product.name" class="col" :class="{ 'd-flex justify-content-center': itemsPerPage === 1 }" />

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
    showHorizontalCard: {
      type: Boolean,
      default: false,
    },

  },
  data() {
    return {
      slides: [],
      itemsPerPage: 5,
      row: '',
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
      if (window.innerWidth < 576) {
        this.row = 'row-cols-1 '
        return 1;
      } else if (window.innerWidth < 682) {
        this.row = 'row-cols-2  me-3'
        return 2;
      } else if (window.innerWidth < 923) {
        this.row = 'row-cols-3'
        return 3;
      } else if (window.innerWidth < 1200) {
        this.row = 'row-cols-4';
        return 4;
      } else {
        this.row = 'row-cols-5';
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