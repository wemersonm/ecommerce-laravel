<template>
  <ModalDialog idModal="register">
    <template v-slot:modal-header-title>
      CRIAR CONTA
    </template>
    <template v-slot:modal-body>
      <FormRegister />
    </template>
    <template v-slot:modal-footer>
      <div class="w-100 text-center">
        <p class="text-secondary">Já possui cadastro?
          <button
            class="ps-1 btn btn-link link-danger link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover"
            @click.stop="onLogin">ENTRAR</button>
        </p>
      </div>
    </template>
  </ModalDialog>
</template>

<script>

import ModalDialog from '../modal/AuthDialog.vue';
import FormRegister from './FormRegister.vue';
import { useModalStore } from "../../stores/modal";

export default {
  data() {
    const modalStore = useModalStore();
    return {
      modalStore,
    };
  },
  methods: {
    async onLogin() {
      this.modalStore.updateModalName("login");
    },
  },
  components: {
    ModalDialog, FormRegister
  },
}
</script>

<style lang="scss" scoped></style>