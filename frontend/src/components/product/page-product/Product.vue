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
      <div class="col-7">
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
      <div class="col-5 shadow ps-3">
        <InfoProduct :product="product"/>
      </div>
    </div>

    <div class="mt-5">
      <Accordion :vHtml="true" :items="description" />

      <!-- <p class="fs-5">Descrição do Produto</p>
      <div v-html="product.description"></div> -->
    </div>
  </div>
</template>

<script>
// @ts-ignore
import Accordion from '../../utils/accordion.vue';
import Breadcrumb from '../../utils/Breadcrumb.vue';
import InfoProduct from './InfoProduct.vue';
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
        name: 'ZOTAC GeForce GTX 1660 Destroyer OC HAZOTAC GeForce GTX 1660 Destroyer OC HA',
        category: {
          name: 'Placa de Video',
          slug: 'placa-de-video'
        },
        brand: {
          name: 'Zotac',
          slug: 'zotac',
        },
        priceDiscount: 989.90,
        priceInstalment: 989.90 + 989.90 * 0.05,
        rating: 4.5,
        qtyReview: 27,
        stock: 250,
        description: '<h2>ZOTAC GeForce GTX 1660 Destroyer OC HA</h2><p>A placa de vídeo Zotac GeForce GTX 1660 com 6GB de memória RAM é uma solução poderosa para entusiastas de jogos que buscam um desempenho sólido e eficiente. Equipada com a arquitetura Turing da NVIDIA, esta placa oferece uma combinação impressionante de velocidade e eficiência energética.</p> <p>Com 6GB de memória GDDR5, a GTX 1660 da Zotac proporciona uma experiência de jogo fluida e responsiva, capaz de lidar com uma variedade de títulos modernos em configurações de qualidade gráfica elevada. Seu design compacto e eficiente em termos de energia faz dela uma escolha excelente para sistemas mais compactos, sem sacrificar o desempenho.</p><p>Além disso, a Zotac é conhecida por sua qualidade de construção e resfriamento eficiente, garantindo que a placa opere em níveis de temperatura ideais mesmo durante sessões de jogo intensas. Com suporte a tecnologias avançadas, como o NVIDIA G-Sync, a GTX 1660 da Zotac proporciona uma experiência de jogo suave, eliminando a fragmentação de tela e melhorando a qualidade visual.</p><p>Em resumo, a Zotac GeForce GTX 1660 6GB é uma escolha confiável para gamers que buscam um equilíbrio entre desempenho sólido, eficiência energética e qualidade de construção, tornando-a uma adição valiosa para qualquer configuração de PC voltada para jogos.</p>',
        favorite: true,
      },

      slug: null,
      description: [],
    };
  },
  methods: {
   
  },
  created() {
    this.description.push({
      header: "Descrição do Produto",
      body: this.product.description
    });
  },
  mounted() {
    this.slug = this.$route?.params?.slug;
  },
  components: { Breadcrumb, Accordion, InfoProduct },
 
}
</script>

<style lang="scss" scoped>

</style>