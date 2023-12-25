<template>
  <header class="container-fluid container-xl ">
    <nav class="navbar navbar-expand-lg">
      <div class="d-flex align-items-center menu gap-1">
        <LogoHeader class="me-3  flex-lg-grow-1" />
        <FormSearch class="d-lg-none form-menu flex-grow-1" />
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions"
          aria-controls="offcanvasWithBothOptions">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
        aria-labelledby="offcanvasWithBothOptionsLabel">
        <NavbarOffcanvasHeader @openModalLoginFromNavbar="openModalLogin" @openModalLoginFromNavIcons="openModalLogin"
          @openModalRegisterFromNavIcons="openModalRegister" />
      </div>
    </nav>
  </header>
  <template v-if="modalLogin">
    <Login @closeModal="closeModal" @openModalRegister="openModalRegister"
      @openModalForgotPassword="openModalForgotPassword"></Login>
  </template>

  <template v-if="modalRegister">
    <Register @closeModal="closeModal" @openModalLogin="openModalLogin" />
  </template>
  <template v-if="modalForgotPassword">
    <ForgotPassword @closeModal="closeModal"  @openModalLogin="openModalLogin"/>

  </template>
</template>

<script>
import { defineAsyncComponent } from 'vue'
import { useAuthStore } from '../../stores/auth';
import NavbarHeader from './navigationheader.vue';
import LogoHeader from './LogoHeader.vue';

// @ts-ignore
import NavIconsHeader from './NavIconsHeader.vue'
import FormSearch from './FormHeader.vue';
import NavbarOffcanvasHeader from './NavbarOffcanvasHeader.vue';

const Login = defineAsyncComponent({
  // @ts-ignore
  loader: () => import('../auth/Login.vue'),
});
const Register = defineAsyncComponent({
  // @ts-ignore
  loader: () => import('../auth/Register.vue'),
});
const ForgotPassword = defineAsyncComponent({
  // @ts-ignore
  loader: () => import('../auth/ForgotPassword.vue'),
});
export default {
  emits: ['getStatusModal'],
  data() {
    const authStore = useAuthStore();
    return {
      modalLogin: false,
      modalRegister: false,
      modalForgotPassword: false,
      auth: true,
      authStore,
    };
  },
  methods: {
    async openModalLogin() {
      this.modalLogin = true;
      this.modalRegister = false;
      this.modalForgotPassword = false;
    },
    async openModalRegister() {
      this.modalLogin = false;
      this.modalRegister = true;
      this.modalForgotPassword = false;
    },
    async openModalForgotPassword() {
      this.modalLogin = false;
      this.modalRegister = false;
      this.modalForgotPassword = true;
    },
    closeModal() {
      this.modalLogin = false;
      this.modalRegister = false;
      this.modalForgotPassword = false;
    }
  },
  components: {
    Login, Register, FormSearch, NavbarHeader, LogoHeader, NavIconsHeader, NavbarOffcanvasHeader, ForgotPassword,
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