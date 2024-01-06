<template>
  <div>
    <div class="card card-vertical text-start shadow-sm h-100" :class="{ 'd-none d-sm-block': showHorizontalCard }"
      @mouseleave="handlerHoverCard(false)" @mouseover="handlerHoverCard(true)">
      <a href="#" class="no-decoration h-100">

        <img class="card-img-top " :src="'https://via.placeholder.com/600/d1212'" alt="Title" />
        <div class="position-absolute top-0 end-0 m-1" v-if="hoverCard">
          <IconsCard />
        </div>
        <div class="card-body h-100 mb-3">
          <p class="card-title mb-1">
            <span class="small fw-semibold ">{{ product.name }}
            </span>
          </p>
          <div class="card-text">
            <p class="mb-1 d-flex flex-nowrap align-items-center" style="height:30px;">
              <span class="small text-danger">R$</span> <span class="text-danger fst-italic me-3 ms-1">
                {{ product.newValue }}
              </span>
              <span class="small text-secondary">R$</span> <span
                class=" small text-decoration-line-through ms-1 text-secondary"> {{ product.oldValue }}</span>
            </p>
            <div class="small">
              <RatingProduct :rating="rating" />
            </div>
            <div class="text-center pt-2">
              <a href="#" @click.prevent.stop="buyProduct"
                class="position-absolute bottom-0 text-center btn btn-dark btn-sm py-2 w-100 start-0">Comprar</a>
            </div>
          </div>
        </div>
      </a>
    </div>
    <HorizontalCardProduct v-if="showHorizontalCard" :product="product" @buyProduct="buyProduct" />
  </div>
</template>

<script>
// @ts-ignore
import HorizontalCardProduct from './HorizontalCardProduct.vue';
import IconsCard from './IconsCard.vue';
import RatingProduct from './RatingProduct.vue';


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
  data() {
    return {
      hoverCard: false,
      rating: 4,
    }
  },
  methods: {
    async handlerHoverCard(hover) {
      // await new Promise(resolve => setTimeout(resolve, 100));
      this.hoverCard = hover;
    },
    buyProduct() {
      this.$router.push({ path: '/carrinho' });
    }
  },
  components: { HorizontalCardProduct, RatingProduct, IconsCard }
}
</script>

<style lang="scss" scoped>
.card-vertical {
  &:hover {
    border-color: $red;
  }

  .no-decoration {
    text-decoration: none;
    color: black;
  }

  .card-title {
    height: 70px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
  }

  .card-img-top {
    height: 50%;
  }

  max-width: 262px;
  max-height: 420px;
  // min-height: 400px;

}
</style>