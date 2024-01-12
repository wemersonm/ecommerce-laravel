<template>
  <div class="row row-cols-1 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-2">
    <CardProduct v-for="(product, index) in products" :product="product" :key="index" class="col"
      :showHorizontalCard="horizontalCard" />
  </div>
</template>



<script>
// @ts-ignore
import CardProduct from './CardProduct.vue';

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
  components: { CardProduct }
}
</script>

<style lang="scss" scoped></style>