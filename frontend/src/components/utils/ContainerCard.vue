<template>
  <div class="d-flex gap-2 overflow-x-scroll">
    <CardProduct :product="product" v-for="i in 20" :key="i" />
  </div>
</template>

<script>
// @ts-ignore
import CardProduct from './CardProduct.vue';
export default {
  data() {
    return {
      product: {
        name: "Placa de video Zotac GTX 1660",
        newValue: 1533,
        oldValue: 1788,
      }
    };
  },
  components: {
    CardProduct,
  },
}
</script>

<style lang="scss" scoped></style>