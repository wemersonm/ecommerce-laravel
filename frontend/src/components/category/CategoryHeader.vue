<template>
  <div class="d-flex justify-content-between">
    <HeaderSection name="Categorias"></HeaderSection>
    <div class="d-flex gap-2 ">
      <i class="bi bi-arrow-left-circle fs-3" type="button" data-bs-target="#carouselCategories" data-bs-slide="prev"></i>
      <i class="bi bi-arrow-right-circle fs-3" type="button" data-bs-target="#carouselCategories"
        data-bs-slide="next"></i>
    </div>
  </div>
</template>

<script>
import HeaderSection from '../utils/HeaderSection.vue';

export default {
  components: { HeaderSection },
  methods: {
    teste() {
      console.log('teste');
    },
    teste2() {
      console.log('2teste22');
    }
  },
}
</script>

<style lang="scss" scoped>
.responsive-font {
  font-size: calc(12px + 0.7vw);
  font-weight: bold;
}
</style>