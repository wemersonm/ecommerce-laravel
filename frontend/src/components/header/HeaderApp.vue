<template>
  <header class="container-fluid container-xl ">
    <nav class="navbar navbar-expand-lg">
      <div class="d-flex align-items-center menu gap-1">
        <LogoHeader class="me-3  flex-lg-grow-1" />
        <FormSearch class="d-lg-none form-menu flex-grow-1" />
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBothOptions"
        aria-labelledby="offcanvasWithBothOptionsLabel">
        <NavbarOffcanvasHeader />
      </div>
    </nav>
  </header>
  <template v-if="modalStore.nameModalActive == 'login'">
    <Login></Login>
  </template>
  <template v-if="modalStore.nameModalActive == 'register'">
    <Register />
  </template>
  <template v-if="modalStore.nameModalActive == 'forgot-password'">
    <ForgotPassword />
  </template>
</template>

<script>
import { defineAsyncComponent } from 'vue'
import { useModalStore } from '../../stores/modal.js'
import LogoHeader from './LogoHeader.vue';
import FormSearch from './FormHeader.vue';
import NavbarOffcanvasHeader from './NavbarOffcanvasHeader.vue';

const Login = defineAsyncComponent({
  loader: () => import('../auth/Login.vue'),
});
const Register = defineAsyncComponent({
  loader: () => import('../auth/Register.vue'),
});
const ForgotPassword = defineAsyncComponent({
  loader: () => import('../auth/ForgotPassword.vue'),
});

export default {
  data() {
    const modalStore = useModalStore();
    return {
      modalStore,
    };
  },
  methods: {},
  components: {
    Login, Register, FormSearch, LogoHeader, NavbarOffcanvasHeader, ForgotPassword,
  },
}
</script>

<style lang="scss" scoped>
header {

  @media (max-width: 991px) {

    .menu {
      width: 100% !important;
    }

    @media (max-width: 355px) {
      .menu {
        flex-flow: row wrap;

        :first-child {
          flex: 1;
        }
      }

      .form-menu {
        order: 3 !important;
        margin: 0;

      }
    }
  }
}
</style>