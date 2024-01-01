<template>
  <div class="my-5 w-100 d-flex justify-content-center align-items-center">
    <a :href="href" class="btn btn-danger px-5 py-2"><span class="small">{{ title }}</span></a>
  </div>
</template>

<script>
export default {
  props: {
    href: {
      type: String,
      default: '#'
    },
    title: {
      type: String,
      default: "Ver todos",
    }
  },
  data() {
    return {

    }
  }
}
</script>

<style lang="scss" scoped></style>