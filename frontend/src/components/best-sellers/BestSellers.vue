<template>
  <Namesection name="Mais Vendidos" />
  <HeaderSection name="Produtos Mais Vendidos" />

  
</template>

<script>
import HeaderSection from '../utils/HeaderSection.vue';
import Namesection from '../utils/NameSection.vue';

export default {
  components: { Namesection, HeaderSection }
}
</script>

<style lang="scss" scoped></style>