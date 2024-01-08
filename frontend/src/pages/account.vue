<template>
  <Default>
    <template v-slot:main>
      <div class="container mt-5">
        <Account />
      </div>
    </template>
  </Default>
</template>

<script>
import Default from '../layouts/default.vue';
import Account from '../components/account/Account.vue';
export default {
  components: {
    Default, Account
  },
}
</script>

<style lang="scss" scoped></style>