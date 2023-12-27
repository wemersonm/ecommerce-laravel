<template>
  <DefaultVue>
    <template v-slot:main>
      <ResetPasswordComponent />
    </template>
  </DefaultVue>
</template>

<script>
// 
import DefaultVue from '../layouts/default.vue';
import ResetPasswordComponent from '../components/reset-password/ResetPassword.vue';
export default {

  components: {
    DefaultVue, ResetPasswordComponent
  },
}

</script>

<style lang="scss" scoped></style>