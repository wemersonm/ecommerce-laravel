<template>
  <div class="card shadow-sm p-0" @mouseleave="handlerHoverCard(false)" @mouseover="handlerHoverCard(true)">
    <a :href="'/produto/' + (product.slug ?? 'poduto-aleatorio-1512')" class="no-decoration h-100">

      <img class="card-img-top" :src="'https://via.placeholder.com/120/d1212'" alt="Title" />
      <div class="position-absolute top-0 end-0 m-1" v-if="hoverCard">
        <IconsCard />
      </div>

      <div class="card-info">
        <div class="card-name mb-1">
          <span class="fw-bold">{{ product.name }}</span>
        </div>
        <div class="card-price d-flex flex-column">
          <span class="text-small-12 text-decoration-line-through text-secondary"> R$ {{ product.oldValue }},00
          </span>
          <span class="fw-bold text-danger font-18">R$ {{ product.newValue }},00</span>
          <span class="text-secondary text-small-12">À vista no PIX</span>
        </div>
        <div class="card-rating small my-2">
          <RatingProduct :rating="product.rating" :qtyReview="59" />
        </div>
        <div class="card-buy text-center">
          <a href="#" @click.prevent.stop="buyProduct" class="btn btn-dark btn-sm w-100 ">Comprar</a>
        </div>
      </div>

    </a>
  </div>
</template>

<script>
import IconsCard from './IconsCardProduct.vue';
import RatingProduct from '../utils/RatingProduct.vue';

export default {
  emits: ['buyProduct'],
  props: {
    product: {
      type: Object,
      default: () => ({}),
    },
  },
  data() {
    return {
      hoverCard: false,
    };
  },
  methods: {
    handlerHoverCard(hover) {
      this.hoverCard = hover;
    },
  },
  components: { RatingProduct, IconsCard }
}
</script>

<style lang="scss" scoped>
.card {

  max-height: 380px;
  max-width: 250px;
  width: 100% !important;

  &:hover {
    border-color: $red;
  }

  .no-decoration {
    text-decoration: none;
    color: black;
  }

  img {
    height: 170px !important;
  }

  .card-info {
    padding: 10px;

    .card-name {
      height: 60px;
      font-size: 13px;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
      
   
    }

  }

  .text-small-12 {
    font-size: 12px;
  }

  .font-18 {
    font-size: 18px !important;
  }


}
</style>