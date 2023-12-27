<template>
  <Form class="w-100" v-slot="{ errors }" @submit="submitForgotPassword" ref="formRef" v-if="!response.showForm">
    <div class="form-floating mb-3">
      <Field type="email" name="email" :class="{ 'form-control': true, 'is-invalid': errors['email'] }" id="floatingemail"
        v-model="form.email" placeholder="name@example.com" rules="required|email" @focus="response.messageError = ''" />
      <label for="floatingemail">Informe o EMAIL de cadastro</label>
      <div class="invalid-feedback ms-1">
        {{ errors["email"] }}
      </div>
    </div>
    <button class="btn btn-lg btn-secondary w-100 my-2 text-center" type="submit">
      <span class="spinner-grow spinner-grow-sm" v-if="response.loading" v-for="i in 3" :key="i" aria-hidden="true"></span>
      <span role="status" v-if="!response.loading">Enviar</span>
    </button>
  </Form>
  <Message class="text-center" :color="response.color" v-if="response.message"
    style="padding: 1rem; padding-left: 0.rem; font-size: 0.9em;">
    <template v-slot:message>
      {{ response.message }}
    </template>
  </Message>
</template>

<script>
import validations from "../../plugins/vee-validate";
import AuthService from "../../services/AuthService";
import Message from "../messages/Message.vue";
const { Form, Field } = validations;

export default {
  data() {
    const { forgotPassword } = AuthService;
    const { required, email } = validations;
    return {
      form: {
        email: '',
      },
      response: {
        loading: false,
        message: '',
        color: 'danger',
        showForm: false,
      },
      required,
      email,
      forgotPassword,
    };
  },
  methods: {
    async submitForgotPassword() {
      this.response.loading = true;
      const payload = { email: this.form.email };
      await this.forgotPassword(payload)
        .then(() => {
          console.log('Deu bom ao enviar');
          this.response.message = "Email de recuperação de senha enviado, verifique seu email";
          this.response.color = 'success';
          this.response.showForm = true;
        })
        .catch((error) => {
          console.log('erro ao enviar');
          this.response.message = "Ocorreu algum erro ao enviar o email de recuperação";
          this.response.showForm = false;
        }).finally(() => {
          this.response.loading = false;
        });
    },
  },

  components: {
    Form,
    Field, Message
  },
};
</script>

<style lang="scss" scoped></style>
