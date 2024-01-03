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

<style lang="scss" scoped>
@media (max-width: 778px) {
  img {
    height: 280px;
  }

  @media (max-width: 528px) {
    img {
      height:230px;
    }
  }
  @media (max-width: 328px) {
    img {
      height:180px;
    }
  }
  @media (max-width: 232) {
    img {
      height:auto;
    }
  }
}
</style>