<template>
  <template v-if="banners.length">

    <div id="banner-carousel" class="carousel slide carousel-fade"  data-bs-ride="carousel" >

      <div class="carousel-indicators">
        <button v-for="(banner, index) in banners" :key="banner.path" type="button"
          data-bs-target="#banner-carousel" :data-bs-slide-to="index" :class="{ active: index == 0 }"
          :aria-current="index == 0 ? 'true' : null" :aria-label="`Slide ${index + 1}`" >
        </button>
      </div>

      <div class="carousel-inner">
        <CarouselItem v-for="banner in banners" :key="banner.path" :banner="banner"  />
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#banner-carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#banner-carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </template>
</template>

<script>
import CarouselItem from './CarouselItem.vue';
export default {
  components: {
    CarouselItem,
  },
  data() {
    return {
      banners: [
        {
          path: 'https://via.placeholder.com/750/61a65', alt: 'image-promotional-banner-1', active: true,
        },
        {
          path: 'https://via.placeholder.com/800/66a35', alt: 'image-promotional-banner-2'
        },
        {
          path: 'https://via.placeholder.com/780/54176f', alt: 'image-promotional-banner-3'
        },
        {
          path: 'https://via.placeholder.com/150/e924e6', alt: 'image-promotional-banner-4'
        },

      ]
    };
  }
}
</script>

<style lang="scss" scoped></style>