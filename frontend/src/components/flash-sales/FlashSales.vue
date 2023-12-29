<template>
  <!-- TOP FLASH-SALES -->
  <HeaderSection name="Hoje" />
  <FlashSalesHeader class="mt-4" @leftSlider="clickLeftFunc" @rightSlider="rightSlider" />
  <ContainerCard class="mt-4 container-card-ref" ref="containerCardRef" />

  <div class="mt-4 w-100 d-flex justify-content-center align-items-center">
    <a href="#" class="btn btn-danger px-5" @click.prevent>Ver Todos</a>
  </div>
</template>

<script>
// @ts-ignore
import HeaderSection from '../utils/HeaderSection.vue';
// @ts-ignore
import FlashSalesHeader from './FlashSalesHeader.vue';
// @ts-ignore
import ContainerCard from '../utils/ContainerCard.vue';
export default {
  data() {
    return {
      containerCard: null,
      widthScroll: null,
    };
  },
  components: {
    HeaderSection, FlashSalesHeader, ContainerCard
  },
  methods: {
    rightSlider() {
      const currentWidth = this.containerCard.scrollLeft + this.containerCard.offsetWidth;
      if (currentWidth < this.containerCard.scrollWidth) {
        this.containerCard.scrollLeft += this.widthScroll;
      }
      return;
    },
    clickLeftFunc() {
      if (this.containerCard.scrollLeft > 0) {
        this.containerCard.scrollLeft -= this.widthScroll;
      }
      return;
    },
  },
  async mounted() {
    await this.$nextTick();
    this.containerCard = this.$refs.containerCardRef?.$el;
    this.widthScroll = 250;
  },
}
</script>

<style lang="scss" scoped>
.container-card-ref {

  scrollbar-width: none;

  &::-webkit-scrollbar {
    display: none;
  }

}
</style>