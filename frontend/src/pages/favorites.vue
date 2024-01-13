<template>
  <div>
    <Default>
      <template v-slot:main>
        <div class="container-lg">
          <Favorites />
        </div>
      </template>
    </Default>
  </div>
</template>

<script>
import Default from '../layouts/default.vue';
import Favorites from '../components/favorites/Favorites.vue';

export default {
  components: { Favorites, Default }
}
</script>

<style lang="scss" scoped></style>