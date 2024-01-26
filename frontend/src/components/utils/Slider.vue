<template>
  <swiper :modules="swiperModules" v-bind="$attrs">
    <swiper-slide v-for=" (slide, index) in slides" :key="index">
      <slot name="slide" :slide="slide">
      </slot>
    </swiper-slide>
  </swiper>
</template>

<script>
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
export default {
  props: {
    slides: {
      type: Array,
      default: [],
      required: true,
    },

  },

  data() {
    return {
      swiperModules: [Navigation, Pagination, Autoplay],

    }
  },
  components: {
    Swiper, SwiperSlide,
  },

}
</script>

<style lang="scss" scoped></style>