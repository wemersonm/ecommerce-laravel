<template>
  <div class="d-flex gap-2 justify-content-end">
    <i class="bi bi-arrow-left-circle fs-3" type="button" @click.prevent.stop="$emit('prev')"></i>
    <i class="bi bi-arrow-right-circle fs-3" type="button" @click.prevent.stop="$emit('next')"></i>
  </div>
</template>

<script>
export default {
  emits: ['prev', 'next'],
}
</script>

<style lang="scss" scoped></style>