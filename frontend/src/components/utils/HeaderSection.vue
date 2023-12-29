<template>
  <div class="d-flex gap-2">
    <div class="boxsize bg-danger rounded "></div>
    <span class="align-self-center fw-bold text-danger"> {{ name }}</span>
  </div>
</template>

<script>
export default {
  props: {
    name: {
      type: String,
      default: '',
      required: true,
    },
  },
}
</script>

<style lang="scss" scoped>
.boxsize {
  width: 20px;
  height: 40px;
}
</style>