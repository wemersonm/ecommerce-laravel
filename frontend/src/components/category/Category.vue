<template>
  <NameSection name="Categorias" />
  <CategoryHeader class="my-4"  />
  <ContainerCategory  />

  <div class="div-x my-5"></div>
</template>

<script>
//@ts-ignore
import ContainerCategory from './ContainerCategory.vue';
//@ts-ignore
import NameSection from '../utils/NameSection.vue';
//@ts-ignore
import CategoryHeader from './CategoryHeader.vue';
export default {

  data() {
    return {
    }
  },

  components: {
    ContainerCategory, NameSection, CategoryHeader
  },
}
</script>

<style lang="scss" scoped>
.responsive-font {
  font-size: calc(15px + 1vw);
}
</style>