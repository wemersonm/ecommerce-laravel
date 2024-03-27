<template>
  <div class="row">
    <div class="col-12">
      <NameSection :name="headerSection.name ?? 'Seção'" />
    </div>
    <div :class="['d-flex justify-content-between align-items-center flex-wrap',
        { 'mt-3': headerSection.title || $slots.middle || headerSection.showNavigation }]">
      <template v-if="headerSection.title">
        <div class="fw-bold order-1 order-sm-0">
          <span class="responsive-font">{{ headerSection.title }}</span>
        </div>
      </template>
      <div class="order-0 order-sm-1 m-auto">
        <slot name="middle"></slot>
      </div>
      <div class="w-100 d-sm-none"></div>
      <template v-if="headerSection.showNavigation">
        <NavigationSlider @prev="onPrevSlide" @next="onNextSlide" class="order-3" />
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