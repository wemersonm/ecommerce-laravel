<template>
  <HeaderSection :target="target" name="Mais Vendidos" title="Produtos mais vendidos" class="mb-3" />
  <SliderProduct :products="products" :target="target" :showHorizontalCard="false" />
</template>

<script>
import SliderProduct from '../product/SliderProduct.vue';
//@ts-ignore
import HeaderSection from '../utils/HeaderSection.vue'
export default {

  data() {
    return {
      target: "BestSellers",
      products: [ // resultado do request no backend .... '-'
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
    }
  },

  components: {
    HeaderSection,
    SliderProduct
  },
}
</script>

<style lang="scss" scoped></style>