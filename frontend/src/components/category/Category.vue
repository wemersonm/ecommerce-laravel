<template>
  <NameSection name="Categorias" />
  <CategoryHeader class="mt-4" @leftSlider="leftSlider" @rightSlider="rightSlider" />
  <ContainerCategory class="my-4" ref="containerCategoryRef" />

  <div class="div-x my-5"></div>
</template>

<script>
//@ts-ignore
import ContainerCategory from './ContainerCategory.vue';
import NameSection from '../utils/NameSection.vue';
import CategoryHeader from './CategoryHeader.vue';
export default {

  data() {
    return {
      containerCategoryRef: null,
      addWidth: 0,
    }
  },
  methods: {
    leftSlider() {
      this.addWidth = 0
      this.containerCategoryRef.scrollLeft -= (210 + this.addWidth);
    },
    rightSlider() {
      this.containerCategoryRef.scrollLeft += (205 + this.addWidth);
    }
  },
  mounted() {
    this.containerCategoryRef = this.$refs.containerCategoryRef.$el;
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