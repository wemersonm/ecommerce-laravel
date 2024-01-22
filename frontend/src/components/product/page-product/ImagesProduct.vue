<template>
  <div>
    <div class="d-flex h-100">
      <div class="d-flex flex-column align-items-center">
        <i class="bi bi-chevron-up fs-4"></i>
        <div class="border p-1" v-for="(img, index) in images"><img :src="img" :alt="'image' + index"
            @click.prevent.stop="changeImg($event)" style="max-width: 100px !important; max-height: 100px !important;">
        </div>
        <i class="bi bi-chevron-down fs-4"></i>
      </div>

      <div class="ms-4 bg-success flex-grow-1 ">

        <img :src="currentImg" alt="imageMain" class="img-fluid w-100 h-100">
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      currentImg: null,
      images: [
        "https://via.placeholder.com/500/f1212",
        "https://via.placeholder.com/500/f4678",
        "https://via.placeholder.com/500/f3635",
        "https://via.placeholder.com/500/f014913",
        "https://via.placeholder.com/500/f00g114",
      ],
    }
  },
  methods: {
    changeImg(event) {
      this.currentImg = event.target.src;
    }
  },
  created() {
    this.currentImg = this.images[0];
  },
}
</script>

<style lang="scss" scoped></style>
