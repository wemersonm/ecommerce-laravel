<template>
  <div>
    <div class="card text-start shadow-sm h-100" :class="{ 'd-none d-sm-block': showHorizontalCard }">
      <img class="card-img-top " :src="'https://via.placeholder.com/600/d' + Math.floor(1000 + Math.random() * 9000)"
        alt="Title" />
      <div class="card-body">
        <h4 class="card-title"><span class="fs-6">{{ product.name }}</span></h4>
        <p class="card-text">R$ <span class="text-danger">{{ product.newValue }}</span> <span
            class="text-decoration-line-through">{{ product.oldValue }}</span>
        </p>
      </div>
    </div>
    <HorizontalCardProduct v-if="showHorizontalCard" :product="product" class="d-xs-block d-sm-none" />
  </div>
</template>

<script>
import HorizontalCardProduct from './HorizontalCardProduct.vue';


export default {
  props: {
    product: {
      type: Object,
      default: () => ({}),
    },
    showHorizontalCard: {
      type: Boolean,
      default: false,
    },
  },
  components: { HorizontalCardProduct }
}
</script>

<style lang="scss" scoped>
.card {
  &:hover {
    border-color: $red;
    transform: scale(1.01);
    transition: 0.5s ease-in-out;
  }

  .card-img-top {
    height: 50%;
  }

  // max-width: 262px;
  max-height: 350px;
  // min-height: 400px;

}
</style>