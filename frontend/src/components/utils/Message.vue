<template>
  <div :class="'alert alert-' + color + ' fade show'" role="alert">
    <slot name="message"></slot>
  </div>
</template>

<script>

export default {
  props: {
    color: {
      type: String,
      default: 'danger'
    },
  },
}

</script>

<style lang="scss" scoped></style>