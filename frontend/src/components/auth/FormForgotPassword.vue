<template>
  <Form class="w-100" v-slot="{ errors }" @submit="submitForgotPassword" ref="formRef">
    <div class="form-floating mb-3">
      <Field type="email" name="email" :class="{ 'form-control': true, 'is-invalid': errors['email'] }" id="floatingemail"
        v-model="form.email" placeholder="name@example.com" rules="required|email" @focus="response.messageError = ''" />
      <label for="floatingemail">Informe o EMAIL de cadastro</label>
      <div class="invalid-feedback ms-1">
        {{ errors["email"] }}
      </div>
    </div>
    <button class="btn btn-secondary w-100 my-2 text-center" type="submit">
      <span class="spinner-grow spinner-grow-sm" v-if="response.loading" aria-hidden="true"></span>
      <span class="spinner-grow spinner-grow-sm" v-if="response.loading" aria-hidden="true"></span>
      <span class="spinner-grow spinner-grow-sm" v-if="response.loading" aria-hidden="true"></span>
      <span role="status" v-if="!response.loading">Enviar</span>
    </button>
    {{ $refs.formRef }}
  </Form>

</template>

<script>
import validations from "../../plugins/vee-validate";
const { Form, Field } = validations;

export default {
  data() {
    const { required, email } = validations;
    return {
      form: {
        email: '',
      },
      response: {
        loading: false,
        messageError: '',
      },
      required,
      email,

    };
  },
  methods: {
    submitForgotPassword() {
      alert('clicado')
    }
  },

  components: {
    Form,
    Field,
  },
};
</script>

<style lang="scss" scoped></style>
