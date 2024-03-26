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

<style lang="scss" scoped>
i {
  transition: transform 0.3s ease, color 0.3s ease-in-out;
}

i:active {
  color: $red;
  transform: scale(1.2);
}
i:hover{
  color: $red;
}

.disable{
  pointer-events: none;
   cursor: not-allowed;
}
</style>