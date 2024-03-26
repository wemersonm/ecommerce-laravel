<template>
  <Slider :slides="items" :breakpoints="swiperBreakpoints" :spaceBetween="10" >
    <template v-slot:slide="{ slide }">
      <slot name="item" :slide="slide"></slot>
    </template>
  </Slider>
</template>

<script>
import CardProduct from '../cards/CardProduct.vue';
import Slider from '../utils/Slider.vue';
export default {
  props: {
    items: {
      type: Array,
      default: () => ({}),
    },
    swiperBreakpoints: {
      type: Object,
      default: () => ({}),
      required: true,
    },

  },
  data() {
    return {
     
    };
  },
  methods: {

  },

  components: {
    CardProduct,
    Slider
  },
  methods: {},
};
</script>

<style lang="scss" scoped></style>