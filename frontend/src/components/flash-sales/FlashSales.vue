<template>
  <!-- TOP FLASH-SALES -->
  <div>
    <NameSection name="Hoje" />
    <FlashSalesHeader class="mt-4" @leftSlider="clickLeftFunc" @rightSlider="rightSlider" />
    <ContainerCard class="my-3" ref="containerCardRef" />
    <div class="my-5 w-100 d-flex justify-content-center align-items-center">
      <a href="#" class="btn btn-danger px-5" @click.prevent>Ver Todos</a>
    </div>
    <div class="div-x my-5"></div>
  </div>
</template>

<script>
// @ts-ignore
import NameSection from '../utils/NameSection.vue';
// @ts-ignore
import FlashSalesHeader from './FlashSalesHeader.vue';
// @ts-ignore
import ContainerCard from './ContainerFlashSales.vue';
export default {
  data() {
    return {
      containerCard: null,
      widthScroll: null,
    };
  },
  components: {
    NameSection, FlashSalesHeader, ContainerCard
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

<style lang="scss" scoped></style>