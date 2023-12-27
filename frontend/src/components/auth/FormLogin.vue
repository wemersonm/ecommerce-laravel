<template>
  <Form class="w-100" v-slot="{ errors }" @submit="submitLogin" ref="formRef">
    <div class="form-floating mb-3">
      <Field type="email" name="email" :class="{ 'form-control': true, 'is-invalid': errors['email'] }" id="floatingEmail"
        v-model="form.email" placeholder="name@example.com" rules="required|email" @focus="response.messageError = ''" />
      <label for="floatingEmail">Email</label>
      <div class="invalid-feedback ms-1">
        {{ errors["email"] }}
      </div>
    </div>
    <div class="form-floating mb-3">
      <Field type="password" name="password" :class="{ 'form-control': true, 'is-invalid': errors['password'] }"
        id="floatingPassword" v-model="form.password" placeholder="Password" rules="required"
        @focus="response.messageError = ''" />
      <label for="floatingPassword">Senha</label>
      <div class="invalid-feedback ms-1">
        {{ errors["password"] }}
      </div>
    </div>
    <AuthMessage v-if="response.messageError" class="mt-3 text-center"
      style="padding: 1rem; padding-left: 0.5rem; font-size: 0.9em;">
      <template v-slot:message>{{ response.messageError }}</template>
    </AuthMessage>
    <button class="btn btn-lg btn-secondary w-100 my-2 text-center" :class="{ disabled: !meta?.meta?.valid }"
      type="submit">
      <span class="spinner-grow spinner-grow-sm" v-if="response.loading" v-for="i in 3" :key="i"
        aria-hidden="true"></span>
      <span role="status" v-if="!response.loading">Logar</span>
    </button>

  </Form>
</template>

<script>
import AuthMessage from "../messages/Message.vue";
import validations from "../../plugins/vee-validate";
import AuthService from "../../services/AuthService.js";
import { useAuthStore } from "../../stores/auth";
import MessagesError from '../../utils/MessagesError.js'

const { Form, Field } = validations;

export default {
  data() {
    const authStore = useAuthStore();
    const { required, email } = validations;
    const { getMessage } = MessagesError;
    return {
      form: {
        email: '',
        password: '',
      },
      response: {
        loading: false,
        messageError: '',
      },
      authStore,
      meta: {},
      required,
      email,
      getMessage,
    };
  },
  methods: {
    async submitLogin() {
      this.response = {
        loading: true,
        messageError: '',
      };
      const { makeLogin } = AuthService;

      const payload = { 'email': this.form.email, 'password': this.form.password };
      await makeLogin(payload, this.authStore)
        .then(() => {
          window.location.reload();
        })
        .catch(error => {
          const code = error.response.data.error;
          this.response.messageError = this.getMessage(code);
          this.response.loading = false;
        });
    },
  },
  mounted() {
    this.$nextTick(() => {
      this.meta = this.$refs.formRef;
    });
  },
  components: {
    Form,
    Field,
    AuthMessage,
  },
};
</script>

<style lang="scss" scoped></style>
