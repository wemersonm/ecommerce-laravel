<template>
  <div id="carouselExample" class="carousel slide border ">
    <div class="carousel-inner border">
      <div class="carousel-item" :class="{ 'active': index === 0 }" v-for="(slide, index) in slides" :key="index">
        <div class="d-flex gap-2  justify-content-center">
          <CardProduct v-for="product in slide" :product="product" :key="product.name" />
        </div>
      </div>
    </div>
 
  </div>
</template>

<script>
// @ts-ignore
import CardProduct from '../product/CardProduct.vue';
export default {
  props: {
    next: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      products: [
        {
          name: "Placa de video Zotac GTX 1660 GB",
          newValue: 1533,
          oldValue: 1788,
        },
        {
          name: "Placa de video GIGABYTE GTX 1060 6GB",
          newValue: 849,
          oldValue: 999,
        },
        {
          name: "Memoria Ram DDR4 8gb Atermiter",
          newValue: 122,
          oldValue: 169,
        },
        {
          name: "Monitor LG 23 polegadas 60 GHZ",
          newValue: 970,
          oldValue: 1120,
        },
        {
          name: "Teclado REDRAGON Kumara k552 Switch Marrom",
          newValue: 170,
          oldValue: 209,
        },
        {
          name: "Placa Mãe Huananzhi X99 8mf LGA-2011-3 DDR4 Dual Channel",
          newValue: 460,
          oldValue: 510,
        },
        {
          name: "Mouse Gammer Razer Basilisk V3 com fio 24k dpi",
          newValue: 290,
          oldValue: 360,
        },
        {
          name: "SSD MVME M2 KingSpec 256GB",
          newValue: 170,
          oldValue: 250,
        }
      ],
      slides: [],
      itemsPerPage: 5,
      currentPage: 0,
    };
  },
  watch: {
    next(newValue, oldValue) {
      console.log('Mudou');
    }
  },
  components: {
    CardProduct,
  },
  methods: {
    createSlides() {
      this.slides = [];
      for (let i = 0; i < this.products.length; i += this.itemsPerPage) {
        this.slides.push(this.products.slice(i, i + this.itemsPerPage));
      }
    },
    itemsPerPageResponsive() {
      if (window.innerWidth < 391) {
        return 1;
      } else if (window.innerWidth < 632) {
        return 2;
      } else if (window.innerWidth < 768) {
        return 3;
      } else if (window.innerWidth < 992) {
        return 4;
      } else {
        return 5;
      }
    },
    handlerResize() {
      this.itemsPerPage = this.itemsPerPageResponsive();
      this.createSlides();
    }
  },
  created() {
    this.itemsPerPage = this.itemsPerPageResponsive();
    this.createSlides();
    window.addEventListener('resize', this.handlerResize);
  },
  destroyed() {
    window.removeEventListener('resize', this.handleResize);
  },
};
</script>

<style lang="scss" scoped>
/* Seus estilos aqui... */
</style>