<template>
  <div class="card text-center flex-grow-1 p-1">
    <img class="mx-auto" :src="category?.path" :alt="'category-' + category.name" />
    <div class="card-body">
      <p class="card-text">{{ category?.name }}</p>
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

  img {
    max-width: 80px;
  }

  width: 100%;
  max-width: 200px;


  max-height: 145px;
  min-height: 145px;

  &:hover {
    border-color: $red;
    color: $red;
    font-weight: bold;
    transition: 0.15s ease-in-out;
  }

}
</style>