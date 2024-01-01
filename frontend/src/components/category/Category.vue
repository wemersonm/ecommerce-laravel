<template>
  <HeaderSection name="Categorias" title="Todas as Categorias" :target="target" class="mb-3" />
  <SliderCategory :target="target" />
  <HorizontalBar class="my-5" />
</template>

<script>
import HorizontalBar from '../utils/HorizontalBar.vue';
//@ts-ignore
import HeaderSection from '../utils/headersection.vue';
import SliderCategory from './SliderCategory.vue';
export default {

  data() {
    return {
      target: "Category",
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