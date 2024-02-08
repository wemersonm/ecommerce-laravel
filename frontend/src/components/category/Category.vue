<template>
  <HeaderSection name="Categorias" title="Todas as Categorias" class="mb-3" @prev="onPrevSlide" @next="onNextSlide" />
  <SliderCategory @swiper="onSwiper" @reachEnd="final" />
  <HorizontalBar class="my-5 " />
</template>

<script>
import HorizontalBar from '../utils/HorizontalBar.vue';
import HeaderSection from '../utils/HeaderSection.vue';
import SliderCategory from './SliderCategory.vue';
export default {

  data() {
    return {
      swiper: null,
    }
  },
  methods: {
    onSwiper(swiper) {
      this.swiper = swiper;
    },
    onPrevSlide() {
      this.swiper.slidePrev();
    },
    onNextSlide() {
      this.swiper.slideNext()
    },
    final() {
      alert('chegou no final');
    }
  },


  components: {
    SliderCategory,
    HeaderSection,
    HorizontalBar
  },
}
</script>

<style lang="scss" scoped>
.responsive-font {
  font-size: calc(15px + 1vw);
}
</style>