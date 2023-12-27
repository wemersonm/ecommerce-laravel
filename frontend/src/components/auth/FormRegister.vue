<template>
  <Form class="w-100" v-slot="{ errors }" @submit="submitRegister" ref="formRef">
    <div class="form-floating mb-3">
      <Field type="text" name="name" :class="{ 'form-control': true, 'is-invalid': errors['name'] }" id="floatingName"
        v-model="form.name" placeholder="Nome Completo" rules="required|min:5|max:100" />
      <label for="floatingName">Nome</label>
      <div class="invalid-feedback">{{ errors['name'] }}</div>

    </div>
    <div class="form-floating mb-3">
      <Field type="email" name="email" :class="{ 'form-control': true, 'is-invalid': errors['email'] }" id="floatingEmail"
        v-model="form.email" placeholder="name@example.com" rules="required|email" />
      <label for="floatingEmail">Email</label>
      <div class="invalid-feedback"> {{ errors['email'] }}</div>
    </div>

    <div class="form-floating mb-3">
      <Field type="password" name="password" :class="{ 'form-control': true, 'is-invalid': errors['password'], }"
        id="floatingPassword" v-model="form.password" placeholder="Password" rules="required|min:6|max:32" />
      <label for="floatingPassword">Senha</label>
      <div class="invalid-feedback">{{ errors['password'] }}</div>
    </div>

    <div class="form-floating mb-3">
      <Field type="password" name="password_confirmation"
        :class="{ 'form-control': true, 'is-invalid': errors['password_confirmation'] }" id="floatingConfirmPassword"
        v-model="form.password_confirmation" placeholder="Password" rules="required|confirmed:@password" />
      <label for="floatingConfirmPassword">Repetir Senha</label>
      <div class="invalid-feedback">{{ errors['password_confirmation'] }}</div>
    </div>

    <AuthMessage v-if="response.messageError" class="mt-3 text-center"
      style="padding: 1rem; padding-left: 0.5rem; font-size: 0.9em;">
      <template v-slot:message>{{ response.messageError }}</template>
    </AuthMessage>

    <button class="btn btn-lg btn-secondary w-100 my-3" :class="{ 'disabled': !meta?.meta?.valid }" type="submit">
      <span class="spinner-grow spinner-grow-sm" v-if="response.loading" v-for="i in 3" :key="i"
        aria-hidden="true"></span>
      <span role="status" v-if="!response.loading">Cadastrar</span>
    </button>

  </Form>
</template>

<script>
import AuthMessage from "../notifications/Message.vue";
import MessagesError from "../../utils/MessagesError";
import { useAuthStore } from '../../stores/auth.js';
import AuthService from '../../services/AuthService.js';
import validations from '../../plugins/vee-validate.js'
const { Form, Field } = validations;
export default {
  data() {
    const { makeRegisterAndLogin } = AuthService;
    const { required, email, min, max, confirmed } = validations;
    const { getMessage } = MessagesError;
    return {
      makeRegisterAndLogin,
      authStore: useAuthStore(),
      meta: {},
      response: {
        loading: false,
        messageError: '',
      },
      form: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      },
      required, email, min, max, confirmed,
      getMessage,
    };
  },
  methods: {
    async submitRegister() {
      this.response = {
        loading: true,
        messageError: '',
      }
      const payload = {
        name: this.form.name,
        email: this.form.email,
        password: this.form.password,
        password_confirmation: this.form.password_confirmation
      };
      await this.makeRegisterAndLogin(payload, this.authStore)
        .then(() => {
          window.location.reload();
        }).catch((error) => {
          const code = error.response.data.error;
          this.response.messageError = this.getMessage(code);
          this.response.loading = false
        });
    },
  },

  async mounted() {
    this.$nextTick(() => {
      this.meta = this.$refs.formRef;
    });

  },
  components: {
    Form, Field, AuthMessage
  },
}
</script>

<style lang="scss" scoped></style>