<template>
  <span class="responsive-font">{{ name }}</span>
</template>

<script>

export default {
  props: {
    name: {
      type: String,
      default: "Seção",
      required: true,
    },
  },
}
</script>

<style lang="scss" scoped>
.responsive-font {
  font-size: calc(12px + 0.7vw);
}
</style>