<template>
  <div>
    <Default>
      <template v-slot:main>
        <div class="container-lg">
          <Product></Product>
        </div>
      </template>
    </Default>
  </div>
</template>

<script>
import Product from '../components/product/page-product/Product.vue';
import Default from '../layouts/default.vue';

export default {
  components: { Product, Default }
}
</script>

<style lang="scss" scoped></style>