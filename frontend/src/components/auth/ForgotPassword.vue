<template>

  <ModalDialog idModal="forgotPassword">
    <template v-slot:modal-header-title>
      RECUPERAR SENHA
    </template>
    <template v-slot:modal-body>
      <FormForgotPassword />
    </template>
  </ModalDialog>
</template>

<script>
import ModalDialog from '../modal/AuthDialog.vue';
import FormForgotPassword from './FormForgotPassword.vue';
export default {
  data() {
    return {
    };
  },
  methods: {
  },

  components: {
    ModalDialog, FormForgotPassword
  },
}
</script>

<style lang="scss" scoped></style>
