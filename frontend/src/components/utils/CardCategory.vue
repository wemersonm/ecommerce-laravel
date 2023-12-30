<template>
  <div class="card text-center">
    <img class="mx-auto" width="70px" :src="category?.path" :alt="'category-' + category.name" />
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
  min-width: 15%;

  &:hover {
    border-color: $red;
    transform: scale(1.01);
    transition: 0.5s ease-in-out;
  }

  @media screen and (max-width: 1400px) {
    min-width: 18%;

    @media screen and (max-width: 992px) {
      min-width: 23%;
      background-color: red;

    }
    @media screen and (max-width: 768px) {
      min-width: 30%;
      background-color: yellow;

    }
    @media screen and (max-width: 576px) {
      min-width: 46%;
      background-color: green;
    }
    @media screen and (max-width: 300px) {
      min-width: 95%;
      background-color: purple;
    }
  }


}
</style>