<template>
  <div class="card">
    <a href="#" class="no-decoration" @click.prevent>
      <div class="row g-0">
        <div class="col-5">
          <img class="card-img-top w-100" :src="'https://via.placeholder.com/600/d1212'" alt="Title" />
        </div>
        <div class="col-7 mb-1">
          <div class="card-body pt-0">
            <div class=" mb-1">
              <IconsCard class="justify-content-end" />
            </div>
            <p class="card-title mb-1 "><span class="small fw-semibold">{{ product.name }}</span></p>
            <p class=" mb-1 card-text d-flex flex-nowrap align-items-center" style="height:30px;">
              <span class="small text-danger">R$</span> <span class="text-danger fst-italic me-3 ms-1">
                {{ product.newValue }}
              </span>
              <span class="small text-secondary">R$</span> <span
                class=" small text-decoration-line-through ms-1 text-secondary"> {{ product.oldValue }}</span>
            </p>
            <div class="card-text">
              <RatingProduct :rating="product.rating" :qtyReview="59" />
            </div>

          </div>
        </div>
      </div>
      <a href="#" @click.prevent.stop="$emit('buyProduct')" class="w-100 btn btn-sm btn-dark mt-1">Comprar</a>
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
    };
  },
  methods: {

  },

  components: { RatingProduct, IconsCard }
}
</script>

<style lang="scss" scoped>
.card {
  &:hover {
    border-color: $red;
  }

  .no-decoration {
    text-decoration: none;
    color: black;
  }

  .card-img-top {
    height: 100%;
  }

  .card-title {
    height: 70px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
  }

  // min-width: 290px;
  width: 100%;
  // max-height: 232px;

}


</style>