<template>
  <div>
    <Header />
    <div class="d-none d-lg-block div-x"></div>
    <main :style="styles">
      <slot name="main"></slot>
    </main>

    <!-- <footer>FOOTER</footer> -->
  </div>
</template>

<script>
// 
import Header from '../components/header/HeaderApp.vue'
export default {
  data() {
    return {
      styles: [],
    };
  },
  components: {
    Header,
  },
  methods: {

  },
}
</script>

<style lang="scss" scoped></style>