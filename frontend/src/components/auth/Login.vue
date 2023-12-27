<template>
  <a href="#" class="d-block btn-sm btn btn-danger mt-3 d-none " data-bs-toggle="modal" data-bs-target="#exampleModal"
    ref="modalLogin">Login</a>

  <Modal @closeModal="getCloseModal" @click.stop.self="clickedOutside" @keydown.esc.prevent="closeModalEsc"
    :style="style">
    <template v-slot:modal-top>
      <div class="text-center">
        <p class="h1 font-family-logo">MyStore</p>
      </div>
    </template>
    <template v-slot:modal-header>
      <button type="button" class="btn-close d-none" data-bs-dismiss="modal" aria-label="Close"
        ref="btnCloseModal"></button>
      <p class="h5 modal-title text-danger">Login</p>
    </template>
    <template v-slot:modal-body>
      <LoginForm />
    </template>
    <template v-slot:modal-footer>
      <div class="d-flex flex-column w-100 text-center">
        <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover mb-4"
          href="#" @click.prevent.stop.self="onOpenForgotPassword">
          Esqueceu a senha?
        </a>
        <p class="mb-0 text-secondary">Novo na Loja!? <a href="#" @click.prevent.stop="goToRegister"
            class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">CADASTRE-SE</a>
        </p>
      </div>
    </template>
  </Modal>
</template>

<script>
import Modal from "../modal/ModalDefault.vue";
import LoginForm from "./FormLogin.vue";
export default {

  emits: ["closeModal", "openModalRegister", 'openModalForgotPassword'],
  data() {
    return {
      openForgotPassword: false,
      closeModal: null,
      modalLogin: null,
      style:"max-width:800px !important;",
    }
  },
  methods: {
    getCloseModal() {
      this.$emit("closeModal");
    },
    async clickedOutside() {
      this.closeModal.click();
      await new Promise(response => setTimeout(response, 500));
      this.$emit("closeModal");
    },
    async goToRegister() {
      this.closeModal.click();
      await new Promise(response => setTimeout(response, 500));
      this.$emit('openModalRegister');
    },
    async closeModalEsc() {
      await new Promise(response => setTimeout(response, 500));
      this.$emit("closeModal");
    },
    async onOpenForgotPassword() {
      this.closeModal.click();
      await new Promise(response => setTimeout(response, 500));
      this.$emit('openModalForgotPassword')
    },
    async openModalLogin() {
      this.openForgotPassword = false;
      await new Promise(response => setTimeout(response, 500));
      this.modalLogin.click();
    }
  },
  async mounted() {
    this.modalLogin = this.$refs.modalLogin;
    this.closeModal = this.$refs.btnCloseModal;
    await this.$nextTick();
    this.modalLogin.click();
  },
  components: {
    Modal, LoginForm
  },
};
</script>

<style lang="scss" scoped></style>
