<template>
  <div :class="[customClass, ]">
    <VerticalCardProduct :product="product" :class="{ 'd-none': windowWidth < horizontalWhen }" />
    <HorizontalCardProduct :product="product" @buyProduct="buyProduct"
      :class="[{ 'd-none': windowWidth >= horizontalWhen }]" />
  </div>
</template>

<script>
import HorizontalCardProduct from './HorizontalCardProduct.vue';
import IconsCard from './IconsCardProduct.vue';
import RatingProduct from '../utils/RatingProduct.vue';
import VerticalCardProduct from './VerticalCardProduct.vue';


export default {
  props: {
    product: {
      type: Object,
      default: () => ({}),
    },
    customClass: {
      type: String,
      default: ''
    },
    horizontalWhen: {
      type: Number,
      default: 482,
    }
  },
  data() {
    return {
      hoverCard: false,
      windowWidth: 0,
    }
  },
  computed: {
  },
  methods: {
    handleResize() {
      this.windowWidth = window.innerWidth;
    },
    buyProduct() {
      this.$router.push({ path: '/carrinho' });
    }
  },
  mounted() {
    this.handleResize();
    window.addEventListener('resize', this.handleResize);
  },
  beforeUnmount() {
    window.removeEventListener('resize', this.handleResize);
  },
  components: { HorizontalCardProduct, VerticalCardProduct, RatingProduct, IconsCard }
}
</script>

<style lang="scss" scoped></style>