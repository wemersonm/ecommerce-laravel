<template>
  <HeaderSection name="Categorias" title="Todas as Categorias" :target="target" class="mb-3" />
  <ContainerCategory :target="target" />
  <HorizontalBar class="my-5" />
</template>

<script>
import HorizontalBar from '../utils/HorizontalBar.vue';
//@ts-ignore
import HeaderSection from '../utils/headersection.vue';
import ContainerCategory from './ContainerCategory.vue';
export default {

  data() {
    return {
      target: "Category",
    }
  },
  components: {
    ContainerCategory,
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