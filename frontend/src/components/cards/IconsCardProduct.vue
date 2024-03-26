<template>
  <div class="z-3 d-flex gap-3">
    <a href="#" @click.prevent.stop="addFavorite" class="text-danger"><i class="bi bi-heart fs-4"></i></a>
    <a href="#" @click.prevent.stop="addToCart" class="text-secondary"><i class="bi bi-cart-plus fs-4"></i></a>
  </div>
</template>

<script>
export default {
  data() {
    return {
    }
  },
  methods: {
    addFavorite() {
      console.log("Favoritos");
    },
    addToCart() {
      console.log("Carrinho");
    }
  },
}
</script>

<style lang="scss" scoped></style>