<template>
  <slider :slides="banners" spaceBetween="10" loop grabCursor :pagination="{ clickable: true }" navigation
    :slides-per-view="perView" :autoplay="{ delay: 3500, disableOnInteraction: false, }">
    <template v-slot:slide="{ slide }">
      <img :src="slide?.path" class="d-block w-100 swiper-lazy" :alt="slide.alt" :style="{ 'max-height': '350px' }">
    </template>
  </slider>
</template>

<script>
//@ts-ignore
import Slider from '../utils/Slider.vue';
export default {
  components: {
    Slider
  },
  data() {
    return {
      perView: 1,
      banners: [
        {
          path: 'https://via.placeholder.com/750/61a65', alt: 'image-promotional-banner-1', active: true,
        },
        {
          path: 'https://via.placeholder.com/800/66a35', alt: 'image-promotional-banner-2'
        },
        {
          path: 'https://via.placeholder.com/780/54176f', alt: 'image-promotional-banner-3'
        },
        {
          path: 'https://via.placeholder.com/780/dg215', alt: 'image-promotional-banner-4'
        },
      ]
    };
  },
  methods: {

  },
}
</script>

<style lang="scss" scoped></style>../utils/SliderCard.vue