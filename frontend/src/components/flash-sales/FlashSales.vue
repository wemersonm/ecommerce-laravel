<template>
  <div>
    <NameSection name="Hoje" />
    <FlashSalesHeader class="my-4" />
    <ContainerCard />
    <ButtonLink href="/flash-sales" title="Ver Todos Produtos"></ButtonLink>
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
import ButtonLink from '../utils/ButtonLink.vue';
export default {
  data() {
    return {
    };
  },
  components: {
    NameSection, FlashSalesHeader, ContainerCard,
    ButtonLink
  },
  methods: {
  }
}
</script>

<style lang="scss" scoped></style>