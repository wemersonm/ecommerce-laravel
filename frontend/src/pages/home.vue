<template>
  <Default>
    <template #main>
      <section :class="{ 'menu-active': statusMenu, 'container-xl container-fluid ': true }">
        <div class="row">
          <div class="col-lg-3 p-0 mt-5">
            <Categories @statusMenu="getStatusMenu" />
          </div>
          <div class="col-1">
            <div class="d-none d-lg-block div-y"></div>
          </div>
          <div class="col-lg-8 p-0 order-first order-lg-last mt-5">
            <Banner />
          </div>
        </div>
      </section>
      <!-- {{ authStore }} -->
    </template>
  </Default>
</template>

<script>
import Default from '../layouts/default.vue';
import Categories from '../components/home/categories/Categories.vue';
import Banner from '../components/home/carousel/CarouselBanner.vue';
// import { useAuthStore } from '../stores/auth';

export default {
  components: {
    Default, Categories, Banner,
  },
  data() {
    // const authStore = useAuthStore();
    return {
      statusMenu: false,
      // authStore,

    };
  },
  methods: {
    getStatusMenu(value) {
      this.statusMenu = value;
    },

  },
}
</script>

<style lang="scss" scoped></style>