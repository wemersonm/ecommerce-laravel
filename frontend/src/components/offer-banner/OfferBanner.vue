<template>
  <div>
    <a :href="offerBanner.product_slug">
      <img :src="offerBanner.src" alt="offerBanner" class="img-fluid rounded">
    </a>
  </div>
</template>

<script>
export default {
  props: {
    offerBanner: {
      type: Object,
      default: {},
    }
  },
}
</script>

<style lang="scss" scoped></style>