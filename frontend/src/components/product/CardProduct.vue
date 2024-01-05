<template>
  <div>
    <div class="card  card-vertical text-start shadow-sm h-100" :class="{ 'd-none d-sm-block': showHorizontalCard }"
      @mouseleave="handlerHoverCard(false)" @mouseover="handlerHoverCard(true)">
      <a href="#" class="no-decoration">
        <img class="card-img-top " :src="'https://via.placeholder.com/600/d1212'" alt="Title" />
        <div class="position-absolute z-3 top-0 end-0 m-1" v-if="hoverCard">
          <a href="#" @click.prevent class="text-danger"><i class="bi bi-heart fs-2"></i></a>
        </div>
        <div class="card-body h-100 mb-3">
          <p class="card-title mb-1">
            <span class="small fw-semibold ">{{ product.name }}
            </span>
          </p>
          <p class="card-text mb-1 d-flex flex-nowrap align-items-center" style="height:30px;">
            <span class="small text-danger">R$</span> <span class="text-danger fst-italic me-3 ms-1">
              {{ product.newValue }}
            </span>
            <span class="small text-secondary">R$</span> <span
              class=" small text-decoration-line-through ms-1 text-secondary"> {{ product.oldValue }}</span>
          </p>
          <div class="card-text">
            <div class="d-flex gap-1 text-secondary align-items-center">
              <i class="bi bi-star-fill" v-for="i in Math.floor(rating)" :key="i"
                :class="{ 'text-warning': i <= rating }"></i>
              <i class="bi bi-star-half text-warning"
                v-if="rating - Math.floor(rating) >= 0.1 && rating - Math.floor(rating) <= 0.9"></i>
              <i class="bi bi-star-fill" v-for="i in 5 - Math.ceil(rating)" :key="'empty-' + i"></i>
              <span class="small text-secondary ms-2">(55)</span>
            </div>
          </div>
        </div>
        <div class="bg-dark add-cart pt-1 text-center position-absolute w-100 bottom-0" v-if="hoverCard">
          <a href="#" class="">Adicionar no Carrinho</a>
        </div>
      </a>
    </div>
    <HorizontalCardProduct v-if="showHorizontalCard" :product="product"/>
  </div>
</template>

<script>
// @ts-ignore
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
    }
  },
  components: { HorizontalCardProduct }
}
</script>

<style lang="scss" scoped>
.card-vertical {
  &:hover {
    border-color: $red;
    transform: scale(1.01);
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

  .add-cart {
    // height: 30px;
    border-radius: 0 0 5px 5px;

    a {
      color: #fff;
      text-decoration: none;
    }
  }

  max-width: 262px;
  max-height: 400px;
  // min-height: 400px;

}
</style>