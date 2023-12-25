<template>
  <div class="carousel-item" :class="{ 'active': banner?.active }"  >
    <img 
    :src="banner?.path"
    class="d-block w-100"
    :alt="banner.alt"
    :style="{ 'max-height': '350px' }"
    >
    <div class="carousel-caption d-none d-md-block">
      <h5>Banner</h5>
      <p>Some representative placeholder content for the first slide.</p>
    </div>
  </div>
</template>

<script>

export default {
  props: {
    banner: {
      type: Object,
      default: () => ({})
    },
  },
  data() {
    return {

    }
  }
}
</script>

<style lang="scss" scoped></style>