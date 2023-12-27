<template>
  <a href="#" class="d-block btn-sm btn btn-danger mt-3 d-none " data-bs-toggle="modal" data-bs-target="#exampleModal"
    ref="modalButton">Cadastre-se</a>

  <Modal @closeModal="getCloseModal" @click.stop.self="clickedOutside" @keydown.esc.prevent="closeModalEsc" :style="style">
    <template v-slot:modal-top>
      <div class="text-center">
        <p class="h1 font-family-logo">MyStore</p>
      </div>
    </template>
    <template v-slot:modal-header>
      <button type="button" class="btn-close d-none" data-bs-dismiss="modal" aria-label="Close"
        ref="btnCloseModal"></button>
      <p class="h5 modal-title text-danger">Cadastre-se</p>
    </template>
    <template v-slot:modal-body>
      <FormRegister />
    </template>
    <template v-slot:modal-footer>
      <p class="me-auto">Já possui cadastro?
        <a href="#" class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
          @click.prevent.stop="goToLogin">ENTRAR</a>
      </p>
    </template>
  </Modal>
</template>

<script>

import Modal from '../modal/ModalDefault.vue';
import FormRegister from './FormRegister.vue';
export default {
  emits: ['closeModal', 'openModalLogin'],
  data() {
    return {
      closeModal: null,
      style:"max-width:800px !important;",
    };
  },
  methods: {
    getCloseModal() {
      this.$emit('closeModal');
    },
    async clickedOutside() {
      this.closeModal.click();
      await new Promise(response => setTimeout(response, 500));
      this.$emit("closeModal");
    },
    async goToLogin() {
      this.closeModal.click();
      await new Promise(response => setTimeout(response, 500));
      this.$emit('openModalLogin');
    },
    async closeModalEsc() {
      await new Promise(response => setTimeout(response, 500));
      this.$emit("closeModal");
    }
  },

  async mounted() {
    this.$refs.modalButton.click();
    this.closeModal = this.$refs.btnCloseModal;
  },
  components: {
    Modal, FormRegister
  },
}
</script>

<style lang="scss" scoped></style>
