<template>
  <div class="card text-start" style="min-width: 250px;">
    <img class="card-img-top" :src="'https://via.placeholder.com/600/d' + Math.floor(1000 + Math.random() * 9000)"
      alt="Title" />
    <div class="card-body">
      <h4 class="card-title"><span class="fs-6">{{ product.name }}</span></h4>
      <p class="card-text">R$ <span class="text-danger">{{ product.newValue }}</span> <span
          class="text-decoration-line-through">{{ product.oldValue }}</span>
      </p>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    product: {
      type: Object,
      default: () => ({}),
    },
  },
}
</script>

<style lang="scss" scoped>
.card {
  &:hover {
    border: 1px solid #1db4e2 !important;
    transform: scale(1.01);
  }
}
</style>