<template>
  <div>
    <NameSection name="Hoje" />
    <FlashSalesHeader class="mt-4"   />
    <ContainerCard :next="next" />
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
      next: false,
      prev: false,
    };
  },
  components: {
    NameSection, FlashSalesHeader, ContainerCard
  },
  methods: {
    rightSlider() {
      console.log('clicado');
      this.next = true;
    },
  }
}
</script>

<style lang="scss" scoped></style>