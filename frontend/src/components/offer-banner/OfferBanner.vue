<template>
  <div>
    <a :href="dataOfferBanner.product_slug">
      <img :src="dataOfferBanner.src" alt="offerBanner" class="img-fluid rounded">
    </a>
  </div>
</template>

<script>
export default {
  data() {
    return {
      dataOfferBanner: {
        src: 'https://fastly.picsum.photos/id/833/1400/500.jpg?hmac=cH9p46o3cruEIwezIHv9TQ6xq2S0WQ-oTgliO2n98BU',
        product_slug: '/product/placa-de-video-gtx-1660-6gb-zotac',
      },
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
      height: 230px;
    }
  }

  @media (max-width: 328px) {
    img {
      height: 180px;
    }
  }

  @media (max-width: 232) {
    img {
      height: auto;
    }
  }
}
</style>