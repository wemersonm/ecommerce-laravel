<template>
  <div>
    <div class="d-flex flex-column">
      <span class="fs-5">{{ product.name }}</span>
      <div class="d-flex justify-content-between align-items-center">
        <span><a class="text-secondary" :href="'/marcas/' + product.brand.slug">{{ product.brand.name }}</a></span>

      </div>
    </div>
    <RatingProduct :rating="product.rating" :qtyReview="product.qtyReview" />

    <div class="d-flex flex-column mt-3">
      <span class="text-secondary">R$ <span class=" text-decoration-line-through">
          {{ toBRL(product.priceDiscount * 1.1) }}</span></span>
      <span class="fs-3 text-danger fw-bold">R$ {{ toBRL(product.priceDiscount)
      }}</span>
      <span class="text-secondary">À vista no PIX com até 5% OFF</span>
    </div>

    <div class="mt-3 text-secondary small">
      <b>R$ {{ toBRL(product.priceInstalment) }}</b>
      <p class="m-0">Em até 10x de <span class="fw-semibold">R$ {{ toBRL(product.priceInstalment / 10) }}</span>
        juros no
        cartão</p>
      <p>Ou em 1x no cartão com até <b>5%</b> OFF</p>
    </div>


    <div class="d-flex align-items-center">
      <div class="btn-group btn-group-sm my-3" role="group">
        <button type="button" class="btn btn-outline-danger" @click.prevent.stop="decrement(min = 1)"><span>-</span>
        </button>
        <input type="text" class="text-center" style="width: 50px;" v-model="counter" v-mask="'####'"
          @input="counterProduct">
        <button type="button" class="btn btn-outline-danger"
          @click.prevent.stop="increment(max = product.stock)"><span>+</span>
        </button>
      </div>
      <span class="text-secondary small ms-3">{{ product.stock }} peças restantes</span>
    </div>


    <div class="d-flex gap-4">
      <button class="btn btn-danger px-4">
        <i class="bi bi-cart2 fs-5"></i>
        <span class="fs-5 ms-2 ">Comprar</span>
      </button>
      <button class="btn btn-danger">
        <i class="bi bi-cart-plus fs-5"></i>
      </button>
      <span class="ms-auto me-3 text-danger">
        <i class="bi bi-heart-fill fs-3 " v-if="product.favorite"></i>
        <i class="bi bi-heart  fs-3" v-else></i>
      </span>
    </div>



    <div class="d-flex mt-4">
      <form method="post" @submit.prevent="submitFreight">
        <span class="small fw-bold mb-2 d-block">Consulte o prazo de entrega</span>
        <div class="input-group">
          <input type="text" id="inputFreight" class="form-control" placeholder="Insira o CEP" v-mask="'#####-###'">
          <button class="btn btn-outline-danger">Consultar</button>
        </div>
      </form>
    </div>
  </div>
</template>


<script>
// @ts-ignore
import RatingProduct from '../RatingProduct.vue';
import { mask } from 'vue-the-mask'
import { useCounter } from '../../../composables/Counter.js'
export default {
  props: {
    product: {
      type: Object,
      default: {},
      required: true,
    },
  },
  data() {
    const { increment, decrement, counter } = useCounter();
    return {
      counter,
      increment,
      decrement,

      style: {
        heightContainerProduct: {
          height: '600px',
        },
        // imageThumb: 'height:calc(100px - 8px)',

      },
    };
  },
  methods: {
    toBRL(number) {
      return number.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    },
    counterProduct() {
      if (this.product.stock < this.counter) this.counter = this.product.stock;
    }
  },
  components: { RatingProduct, },
  directives: {
    mask,
  }
}
</script>

<style lang="scss" scoped>
.color {
  color: $colorInStock;
  font-weight: bold;
}
</style>