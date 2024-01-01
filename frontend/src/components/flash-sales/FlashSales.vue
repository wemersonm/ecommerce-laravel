<template>
  <div>
    <HeaderSection name="Ofertas" title="Ofertas Relâmpago" :target="target" class="mb-3">
      <template v-slot:middle>
        <CountDown />
      </template>
    </HeaderSection>
    <ContainerCard :target="target" />
    <ButtonLink href="/flash-sales" title="Ver Todos Produtos" class="my-5"></ButtonLink>
    <HorizontalBar />
  </div>
</template>

<script>
import HeaderSection from '../utils/HeaderSection.vue';
import ContainerCard from './ContainerFlashSales.vue';
import ButtonLink from '../utils/ButtonLink.vue';
import CountDown from '../utils/CountDown.vue';
import HorizontalBar from '../utils/HorizontalBar.vue';
export default {
  data() {
    return {
      target: "FlashSales",
    };
  },
  components: {
    ContainerCard, HeaderSection,
    ButtonLink,
    CountDown,
    HorizontalBar
  },
  methods: {
  }
}
</script>

<style lang="scss" scoped></style>