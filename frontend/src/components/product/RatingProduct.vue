<template>
  <div class="d-flex gap-1 text-secondary align-items-center ">
    <i class="bi bi-star-fill" v-for="i in Math.floor(rating)" :key="i" :class="{ 'text-warning': i <= rating }"></i>
    <i class="bi bi-star-half text-warning"
      v-if="rating - Math.floor(rating) >= 0.1 && rating - Math.floor(rating) <= 0.9"></i>
    <i class="bi bi-star-fill" v-for="i in 5 - Math.ceil(rating)" :key="'empty-' + i"></i>
    <span class="small text-secondary ms-1">({{ qtyReview }})</span>
  </div>
</template>

<script>
export default {
  props: {
    rating: {
      type: Number,
      default: 0
    },
    qtyReview: {
      type: Number,
      default: 0,
    }
  },
}
</script>

<style lang="scss" scoped></style>