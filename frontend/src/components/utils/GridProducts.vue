<template>
  <div :class="{ 'row g-3': true, ['row-cols-' + cols]: true, }" ref="containerGrid">
    <CardProduct class="['col d-flex justify-content-center']" v-for="(product, index) in products" :product="product"
      :key="index" />
  </div>
</template>

<script>
import CardProduct from '../cards/CardProduct.vue';
export default {
  props: {
    products: {
      type: Object,
      default: {},
      required: true,
    },
    horizontalCard: {
      type: Boolean,
      default: true,
    }
  },
  data() {
    return {
      cols: null,
      breakpoints: [
        { width: 1, cols: 1 },
        { width: 482, cols: 2 },
        { width: 622, cols: 3 },
        { width: 792, cols: 4 },
        { width: 998, cols: 5 },
      ],
    };
  },
  methods: {
    updateCols() {

      const containerWidth = window.innerWidth;

      if (containerWidth >= 1158) {
        this.cols = 5;
        return;
      }
      const breakpointMatch = this.breakpoints.findIndex(bp => containerWidth < bp.width);
      this.cols = (this.breakpoints[breakpointMatch - 1]).cols;
    },

  },
  mounted() {
    this.updateCols();
    window.addEventListener('resize', this.updateCols);
  },
  beforeUnmount() {
    window.removeEventListener('resize', () => { });
  },

  components: { CardProduct }
}
</script>

<style lang="scss" scoped></style>