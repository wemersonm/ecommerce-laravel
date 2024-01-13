<template>
  <div>
    <Breadcrumb class="no-decoration my-5">
      <template v-slot:list>
        <li class="breadcrumb-item"><a href="/">Pagina Inicial</a></li>
        <li class="breadcrumb-item "><a :href="'/categoria/' + product.category.slug">{{
          product.category.name }}</a></li>
      </template>
    </Breadcrumb>
    <div class="row w-100" :style="style.widthContainerProduct">
      <div class="col-7 border">
        <div class="d-flex">
          <div class="d-flex flex-column gap-2">
            <div class="border h-100" :style="style.imageThumb"><img src="https://via.placeholder.com/100/f1212"
                alt="image"></div>
            <div class="border h-100" :style="style.imageThumb"><img src="https://via.placeholder.com/100/f1212"
                alt="image"></div>
            <div class="border h-100" :style="style.imageThumb"><img src="https://via.placeholder.com/100/f1212"
                alt="image"></div>
            <div class="border h-100" :style="style.imageThumb"><img src="https://via.placeholder.com/100/f1212"
                alt="image"></div>
            <div class="border h-100" :style="style.imageThumb"><img src="https://via.placeholder.com/100/f1212"
                alt="image"></div>
          </div>
          <div class="w-100 h-100 ms-4">
            <img src="https://via.placeholder.com/600/92c952" class="img-fluid w-100" alt="mainImage">
          </div>
        </div>

      </div>
      <div class="col-5 border border-success">
          
      </div>
    </div>
  </div>
</template>

<script>
// @ts-ignore
import Breadcrumb from '../utils/Breadcrumb.vue';

export default {
  data() {
    return {
      style: {
        widthContainerProduct: 'width: 650px',
        imageThumb: 'max-height:100px',

      },
      product: {
        id: 1533,
        name: 'ZOTAC GeForce GTX 1660 Destroyer OC HA',
        category: {
          name: 'Placa de Video',
          slug: 'placa-de-video'
        },


      },

      slug: null,

    };
  },
  mounted() {
    this.slug = this.$route?.params?.slug;
  },
  components: { Breadcrumb }
}
</script>

<style lang="scss" scoped></style>