<template>
  <AuthDialog idModal="login">
    <template v-slot:modal-header-title>
      FAZER LOGIN
    </template>
    <template v-slot:modal-body>
      <LoginForm />
    </template>
    <template v-slot:modal-footer>
      <div class="d-flex flex-column w-100 text-center">
        <button
          class="btn btn-link link-primary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover"
          @click.stop="onForgotPassword">
          Esqueceu a senha?
        </button>
        <p class="mb-0 text-secondary">Novo na Loja!? <button
            class="btn btn-link ps-1 link-danger link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover"
            @click.stop="onRegister">CADASTRE-SE</button>
        </p>
      </div>
    </template>
  </AuthDialog>
</template>

<script>
import AuthDialog from "../modal/AuthDialog.vue";
import LoginForm from "./FormLogin.vue";
import { useModalStore } from "../../stores/modal";
export default {
  data() {
    const modalStore = useModalStore();
    return {
      modalStore,
    }
  },
  methods: {
    onForgotPassword() {
      this.modalStore.updateModalName("forgot-password")
    },
    onRegister() {
      this.modalStore.updateModalName("register");
    }
  },
  components: {
    AuthDialog, LoginForm
  },
};
</script>

<style lang="scss" scoped></style>
