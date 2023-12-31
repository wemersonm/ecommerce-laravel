<template>
  <div class="card text-start ">
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
    border-color: $red;
    transform: scale(1.01);
    transition: 0.5s ease-in-out;
  }

  max-width: 250px;
  max-height: 400px;
  min-height: 400px;
  
}
</style>