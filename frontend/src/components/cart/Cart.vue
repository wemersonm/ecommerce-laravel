<template>
  <div class="border border-warning">
    <Breadcrumb class="my-5">
      <template v-slot:list>
        <li class="breadcrumb-item"><a href="/">Pagina Inicial</a></li>
        <li class="breadcrumb-item active ">Carrinho</li>
      </template>
    </Breadcrumb>


    <div class="d-flex">
      <div class="border border-danger" style="flex:7.5;">

        <div class="row p-1 mx-0 my-2 bg-light" v-for="(product, index) in products" :key="product.name">
          <div class="col-2">
            <img :src="product.image" :alt="'image' + index">
          </div>
          <div class="col-7">
            <p class="small text-secondary mb-0">{{ product.brand }}</p>
            <a class="link-name fw-semibold small text-dark" :href="'produto/' + product.slug">
              <span>
                {{ product.name }}
              </span>
            </a>
            <div class="d-flex">
              <p></p>
            </div>
          </div>
          <div class="col-3">
            actions
          </div>
        </div>

      </div>
      <div class="border border-success sticky-top h-100" style="flex:2.5; ">
        <h1>resumo dos valores</h1>
      </div>
    </div>


  </div>
</template>

<script>
import Breadcrumb from '../utils/Breadcrumb.vue';

export default {
  data() {
    return {
      products: [
        {
          image: 'https://via.placeholder.com/100/92c952',
          name: 'Placa de Video ZOTAC GTX 1660 6GB',
          slug: 'placa-de-video-zotac-gtx-1660-gb',
          brand: 'Zotac',
          priceDiscount: 989.90,
          priceInstalment: 989.90 + 989.90 * 0.05,

        },
        {
          image: 'https://via.placeholder.com/100/9sdhg',
          name: 'Memoria Ram ATERMITER 8GB 3200 Mhz',
          slug: 'memoria-ram-atermiter-8gb-3200-mhz',
          brand: 'Atermiter',
          priceDiscount: 179.99,
          priceInstalment: 179.99 + 179.99 * 0.05,
        },
        {
          image: 'https://via.placeholder.com/100/a1212',
          name: 'SSD M.2 NVME 512GB Kingspec',
          slug: 'ssd-m2-nvme-512gb-kingspec',
          brand: 'Kingspec'
        },
      ],
    }
  },
  components: { Breadcrumb }
}
</script>

<style lang="scss" scoped>
.link-name {
  text-decoration: none;

  &:hover {
    text-decoration: underline;
  }
}
</style>