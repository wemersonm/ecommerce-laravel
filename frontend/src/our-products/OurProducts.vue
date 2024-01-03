<template>
  <HeaderSection name="Nosso Produtos" title="Conheça nossos produtos" :showNavigation="false" />
  <GridProduct :products="products" class="mt-4" />
  <ButtonLink href="/products" title="Ver Todos os Produtos" class="mt-4" />
</template>

<script>
//@ts-ignore
import GridProduct from '../components/product/GridProduct.vue';
import ButtonLink from '../components/utils/ButtonLink.vue';
import HeaderSection from '../components/utils/HeaderSection.vue';

export default {
  data() {
    return {
      products: [
        {
          name: "Placa de video Zotac GTX 1660 GB",
          newValue: 1414,
          oldValue: 1788,
        },
        {
          name: "Placa de video GIGABYTE GTX 1060 6GB",
          newValue: 124,
          oldValue: 342,
        },
        {
          name: "Memoria Ram DDR4 8gb Atermiter",
          newValue: 145,
          oldValue: 235,
        },
        {
          name: "Monitor LG 23 polegadas 60 GHZ",
          newValue: 89,
          oldValue: 1451,
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
          newValue: 1212,
          oldValue: 1455,
        },
        {
          name: "SSD MVME M2 KingSpec 256GB",
          newValue: 1231,
          oldValue: 1515,
        },
        {
          name: "Gabinete T-DAGGER 3 Fans Frontal, ATX ",
          newValue: 444,
          oldValue: 1214,
        }
      ],
    };
  },
  components: { GridProduct, HeaderSection, ButtonLink }
}
</script>

<style lang="scss" scoped></style>
