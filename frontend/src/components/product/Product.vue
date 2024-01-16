<template>
  <div>
    <Breadcrumb class="no-decoration my-5">
      <template v-slot:list>
        <li class="breadcrumb-item"><a href="/">Pagina Inicial</a></li>
        <li class="breadcrumb-item "><a :href="'/categoria/' + product.category.slug">{{
          product.category.name }}</a></li>
      </template>
    </Breadcrumb>
    <div class="row w-100" :style="style.heightContainerProduct">
      <div class="col-7 border">
        <div class="d-flex h-100">
          <div class="d-flex flex-column">
            <div class="border p-1"><img src="https://via.placeholder.com/100/f1212" alt="image"></div>
            <div class="border p-1"><img src="https://via.placeholder.com/100/f1212" alt="image"></div>
            <div class="border p-1"><img src="https://via.placeholder.com/100/f1212" alt="image"></div>
            <div class="border p-1"><img src="https://via.placeholder.com/100/f1212" alt="image"></div>
            <div class="border p-1"><img src="https://via.placeholder.com/100/f1212" alt="image"></div>
          </div>
          <div class="ms-4 bg-success flex-grow-1">
            <img src="https://via.placeholder.com/600/fdsg" alt="imageMain" class="img-fluid w-100">
          </div>
        </div>

      </div>
      <div class="col-5 border border-success">
        <div>
          <div class="d-flex flex-column">
            <span class="fs-5">{{ product.name }}</span>
            <span><a class="text-secondary" :href="'/marcas/' + product.brand.slug">{{ product.brand.name }}</a></span>
          </div>
          <RatingProduct :rating="product.rating" :qtyReview="product.qtyReview" />

          <div class="d-flex flex-column mt-3">
            <span class="text-secondary">R$ <span class=" text-decoration-line-through">
                {{ product.price * 1.1 }}</span></span>
            <span class="fs-3 text-danger fw-bold">R$ {{ toBRL((product.price - (product.price * 0.05)))
            }}</span>
            <span class="text-secondary">À vista no PIX com até 5% OFF</span>
          </div>

          <div class="mt-3 text-secondary small">
            <b>R$ {{ toBRL(product.price) }}</b>
            <p class="m-0">Em até 10x de <span class="fw-semibold">R$ {{ toBRL(product.price / 10) }}</span> juros no
              cartão</p>
            <p>Ou em 1x no cartão com até <b>5%</b> OFF</p>
          </div>

          <div class="d-flex gap-4">
            <button class="btn btn-danger px-4">
              <i class="bi bi-cart2 fs-5"></i>
              <span class="fs-5 ms-2 ">Comprar</span>
            </button>
            <button class="btn btn-danger">
              <i class="bi bi-cart-plus fs-5"></i>
            </button>
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
      </div>
    </div>

    <div class="mt-5">
      <div v-html="product.description"></div>
    </div>
  </div>
</template>

<script>
// @ts-ignore
import RatingProduct from './RatingProduct.vue';
import Breadcrumb from '../utils/Breadcrumb.vue';
import { mask } from 'vue-the-mask'

export default {
  data() {
    return {
      style: {
        heightContainerProduct: {
          height: '600px',
        },
        // imageThumb: 'height:calc(100px - 8px)',

      },
      product: {
        id: 1533,
        name: 'ZOTAC GeForce GTX 1660 Destroyer OC HA',
        category: {
          name: 'Placa de Video',
          slug: 'placa-de-video'
        },
        brand: {
          name: 'Zotac',
          slug: 'zotac',
        },
        price: 989.90,

        rating: 4.5,
        qtyReview: 27,
        stock: 250,
        description: '<h2>Pega a rajada de 30 só eco vindo barulhento</h2>',

      },

      slug: null,

    };
  },
  methods: {
    toBRL(number) {
      return number.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    }
  },
  mounted() {
    this.slug = this.$route?.params?.slug;
  },
  components: { Breadcrumb, RatingProduct },
  directives: {
    mask,
  }
}
</script>

<style lang="scss" scoped></style>