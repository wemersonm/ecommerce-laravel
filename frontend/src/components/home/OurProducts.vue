<template>
  <HeaderSection :headerSection="headerSection" class="mb-3" />
  <GridProduct :products="products" />
  <ButtonLink href="/products" title="Ver Todos os Produtos" class="my-4 my-md-5" />
  <HorizontalBar />
</template>

<script>
import GridProduct from '../utils/GridProducts.vue';
import ButtonLink from '../utils/ButtonLink.vue';
import HeaderSection from '../utils/HeaderSection.vue';
import HorizontalBar from '../utils/HorizontalBar.vue';

export default {
  data() {
    return {
      headerSection: {
        name: "Nosso Produtos",
        title: "Conheça nossos produtos",
        showNavigation: false,
      },
      products: [
        {
          name: "Placa de video Zotac GTX 1660 GB",
          newValue: 1414,
          oldValue: 1788,
          rating: 4
        },
        {
          name: "Placa de video GIGABYTE GTX 1060 6GB",
          newValue: 124,
          oldValue: 342,
          rating: 4
        },
        {
          name: "Memoria Ram DDR4 8gb Atermiter",
          newValue: 145,
          oldValue: 235,
          rating: 4
        },
        {
          name: "Monitor LG 23 polegadas 60 GHZ",
          newValue: 89,
          oldValue: 1451,
          rating: 4
        },
        {
          name: "Teclado REDRAGON Kumara k552 Switch Marrom",
          newValue: 170,
          oldValue: 209,
          rating: 4
        },
        {
          name: "Placa Mãe Huananzhi X99 8mf LGA-2011-3 DDR4 Dual Channel",
          newValue: 460,
          oldValue: 510,
          rating: 4
        },
        {
          name: "Mouse Gammer Razer Basilisk V3 com fio 24k dpi",
          newValue: 1212,
          oldValue: 1455,
          rating: 4
        },
        {
          name: "SSD MVME M2 KingSpec 256GB",
          newValue: 1231,
          oldValue: 1515,
          rating: 4
        },
        {
          name: "Gabinete T-DAGGER 3 Fans Frontal, ATX ",
          newValue: 444,
          oldValue: 1214,
          rating: 4
        }
      ],
    };
  },
  components: { GridProduct, HeaderSection, ButtonLink,HorizontalBar }
}
</script>

<style lang="scss" scoped></style>
