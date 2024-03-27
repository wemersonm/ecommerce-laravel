<template>
  <div>
    <div class="card text-center flex-grow-1 p-1">
      <img class="mx-auto" :src="category?.path" :alt="'category-' + category.name" />
      <div class="card-text pt-2">
        <p class="fw-bold p-0 m-0">{{ category?.name }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    category: {
      type: Object,
      default: () => ({}),
    },
  },
}
</script>

<style lang="scss" scoped>
.card {
  box-sizing: border-box !important;

  img {
    max-width: 80px;
  }

  width: 100%;
  max-width: 200px;
  height: 140px;

  .card-text {
    height: 100%;

    p {
      font-size: clamp(12px,calc(9px + 0.5vw),14px);
    }
  }

  &:hover {
    border-color: $red;
    color: $red;
    font-weight: bold;
    transition: 0.15s ease-in-out;
  }

}
</style>