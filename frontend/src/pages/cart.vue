<template>
  <Default>
    <template #main>
      <Cart></Cart>
    </template>
  </Default>
</template>

<script>
import Cart from '../components/cart/Cart.vue';
import Default from '../layouts/default.vue';

export default {
  components: { Cart, Default }
}
</script>

<style lang="scss" scoped></style>