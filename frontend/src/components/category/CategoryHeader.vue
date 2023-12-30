<template>
  <div class="d-flex justify-content-between ps-1">
      <HeaderSection name="Categorias"></HeaderSection>
    <div class="d-flex gap-2 justify-content-end border pe-2">
      <i class="bi bi-arrow-left-circle fs-3" @click="$emit('leftSlider')"></i>
      <i class="bi bi-arrow-right-circle fs-3" @click="$emit('rightSlider')"></i>
    </div>
  </div>
</template>

<script>
import HeaderSection from '../utils/HeaderSection.vue';

export default {
  emits: ['leftSlider', 'rightSlider'],
  components: { HeaderSection }
}
</script>

<style lang="scss" scoped>
.responsive-font {
  font-size: calc(12px + 0.7vw);
}
</style>