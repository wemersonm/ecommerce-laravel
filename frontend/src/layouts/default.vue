<template>
  <div>
    <Header />
    <div class="d-none d-lg-block div-x"></div>
    <main>
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