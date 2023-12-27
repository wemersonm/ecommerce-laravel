<template>
  <div class="container-lg">
    <div class="text-center my-5">
      <p class="h2">Recuperar Senha</p>
    </div>
    <div class="col-md-6 mx-auto my-4" v-if="response.showForm">
      <FormResetPassword @passwordChanged="passwordChanged" />
    </div>
    <div class="text-center my-4" v-else>
      <Message color="success">
        <template v-slot:message>{{ response.message }}</template>
      </Message>
      <div class="d-flex justify-content-center" v-if="response.spinner">
        <div class="spinner-border" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    </div>
    <div class="col-md-6 mx-auto text-center small alert alert-secondary" v-if="response.showForm">
      <p>Sua senha deve conter tamanho mínimo de 6 caracteres e máximo de 32.</p>
    </div>
  </div>
</template>
<script>

import FormResetPassword from '../reset-password/FormResetPassword.vue';
import Message from '../messages/Message.vue'
export default {
  data() {
    return {
      response: {
        showForm: true,
        spinner: false,
        message: '',
      }
    }
  },
  methods: {
    async passwordChanged() {
      this.response.message = "Senha alterada com sucesso. Voltando para a página incial ..."
      this.response.showForm = false;
      this.response.spinner = true;

      await new Promise((resolve) => {
        setTimeout(resolve, 4000);
      });
      history.replaceState(null, null, '/');
      window.location.replace('/');
    }
  },
  components: {
    FormResetPassword, Message
  },
}

</script>

<style lang="scss" scoped></style>