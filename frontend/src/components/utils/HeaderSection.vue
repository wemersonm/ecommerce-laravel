<template>
  <div class="row">
    <div class="col-12">
      <NameSection :name="headerSection.name ?? 'Seção'" />
    </div>
    <div class="d-flex justify-content-between mt-4">
      <div class="fw-bold">
        <span class="responsive-font">{{ headerSection.title ?? 'Titulo' }}</span>
      </div>
      <slot name="middle"></slot>
      <template v-if="headerSection.showNavigation">
        <NavigationSlider @prev="onPrevSlide" @next="onNextSlide" />
      </template>
    </div>
  </div>
</template>

<script>
import NameSection from './NameSection.vue';
import NavigationSlider from './NavigationSlider.vue';
export default {
  props: {
    headerSection: {
      type: Object,
      required: true,
      default: {},
    },
    swiper: {
      type: Object,
      default: {},
    },
  },
  data() {
    return {
    }
  },
  methods: {
    onPrevSlide() {
      this.swiper.slidePrev();
    },
    onNextSlide() {
      this.swiper.slideNext();
    }
  },
  components: { NameSection, NavigationSlider }
}
</script>

<style lang="scss" scoped>
.responsive-font {
  font-size: calc(12px + 0.7vw);
}

.bi-arrow-left-circle,
.bi-arrow-right-circle {
  &:hover {
    transform: scale(1.1);
    color: $red;
  }
}
</style>