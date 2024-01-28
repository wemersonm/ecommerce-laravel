<template>
  <div>
    <HeaderSection name="Ofertas" title="Ofertas Relâmpago" class="mb-3" @prev="prevSlider" @next="nextSlider">
      <template v-slot:middle>
        <CountDown />
      </template>
    </HeaderSection>
    <SliderProduct :products="products" :showHorizontalCard="true" @swiper="onSwiper"  />
    <ButtonLink href="/flash-sales" title="Ver Todos Produtos" class="my-5"></ButtonLink>
    <HorizontalBar />
  </div>
</template>

<script>
import HeaderSection from '../utils/HeaderSection.vue';
import SliderProduct from '../product/SliderProduct.vue';
import ButtonLink from '../utils/ButtonLink.vue';
//@ts-ignore
import CountDown from '../utils/CountDown.vue';
import HorizontalBar from '../utils/HorizontalBar.vue';
import Slider from '../utils/Slider.vue';
export default {
  data() {
    return {
      swiper: null,
      products: [ // request do backend ... '-'
        {
          name: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita reprehenderit odio quis amet accusamus quos. Nobis delectus placeat quo provident sit, explicabo ratione laborum quisquam inventore amet ut aliquam exercitationem.",
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

     
    };
  },
  methods: {
    onSwiper(swiper) {
      this.swiper = swiper;
    },
    prevSlider() {
      console.log("GG prev");
      this.swiper.slidePrev();
    },
    nextSlider() {
      console.log("GG next");
      this.swiper.slideNext();
    }
  },
  components: {
    SliderProduct, HeaderSection,
    ButtonLink,
    CountDown,
    HorizontalBar,
    Slider
  },

}
</script>

<style lang="scss" scoped></style>