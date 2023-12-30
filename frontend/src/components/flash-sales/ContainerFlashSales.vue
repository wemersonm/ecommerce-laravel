<template>
  <div class="d-flex overflow-x-scroll container-card-ref">
    <CardProduct :product="product" v-for="i in 20" :key="i" />
  </div>
</template>

<script>
// @ts-ignore
import CardProduct from '../utils/CardProduct.vue';
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

<style lang="scss" scoped>
.container-card-ref {

scrollbar-width: none;

&::-webkit-scrollbar {
  display: none;
}

}
</style>