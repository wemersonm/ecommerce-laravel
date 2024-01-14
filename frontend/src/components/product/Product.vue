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
          <span class="fs-5">{{ product.name }}</span>
          <RatingProduct :rating="product.rating" :qtyReview="product.qtyReview" />

          <div class="d-flex flex-column mt-3">
            <span class="text-secondary">R$<span class=" text-decoration-line-through">
                {{ product.price * 1.1 }}</span></span>
            <span class="fs-4">R$ {{ product.price }}</span>
          </div>

          
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// @ts-ignore
import RatingProduct from './RatingProduct.vue';
import Breadcrumb from '../utils/Breadcrumb.vue';

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
        price: 989.90,
        rating: 4.5,
        qtyReview: 27,


      },

      slug: null,

    };
  },
  mounted() {
    this.slug = this.$route?.params?.slug;
  },
  components: { Breadcrumb, RatingProduct }
}
</script>

<style lang="scss" scoped></style>