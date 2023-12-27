<template>
  <Form @submit="submitResetPassword" v-slot="{ errors }">
    <div class="form-floating mb-3">
      <Field type="email" name="email" class="form-control" id="floatingEmail" rules="required|email"
        placeholder="example@email.com" :class="{ 'is-invalid': errors['email'] }" v-model="form.email" />
      <label for="floatingEmail">Email</label>
      <div class="invalid-feedback">{{ errors['email'] }}</div>
    </div>
    <div class="form-floating mb-3">
      <Field type="password" name="password" class="form-control" id="floatingPassword" rules="required|min:6|max:32"
        placeholder="******" :class="{ 'is-invalid': errors['password'] }" v-model="form.password" />
      <label for="floatingPassword">Nova Senha</label>
      <div class="invalid-feedback">{{ errors['password'] }}</div>
    </div>
    <div class="form-floating mb-3">
      <Field type="password" name="confirm_password" class="form-control" id="floatingPasswordConfirm"
        rules="required|confirmed:@password" placeholder="Password" :class="{ 'is-invalid': errors['confirm_password'] }"
        v-model="form.confirm_password" />
      <label for="floatingPasswordConfirm">Repita a Nova Senha</label>
      <div class="invalid-feedback">{{ errors['confirm_password'] }}</div>
    </div>
    <Message v-if="response.message" class="mt-4">
      <template v-slot:message>{{ response.message }}</template>
    </Message>
    <button class="btn btn-secondary w-100 my-2 text-center" type="submit">
      <span class="spinner-grow spinner-grow-sm" v-if="response.loading" v-for="i in 3" :key="i"
        aria-hidden="true"></span>
      <span role="status" v-if="!response.loading">Alterar</span>
    </button>

  </Form>
</template>

<script>  
import validations from '../../plugins/vee-validate';
import AuthService from '../../services/AuthService.js'
import Messages from '../../utils/MessagesError.js'
import Message from '../notifications/Message.vue';
import axios from '../../plugins/Axios';
const { Form, Field } = validations;
export default {
  emits: ['passwordChanged'],
  data() {

    const { required, min, max, email, confirmed } = validations;

    return {
      form: {
        email: 'teste@email.com',
        password: 'asasas',
        confirm_password: 'asasas',
      },
      response: {
        loading: false,
        message: '',
      },
      meta: {},
      required, min, max, confirmed, email
    };
  },
  methods: {
    async submitResetPassword() {
      const payload = {
        email: this.form.email,
        password: this.form.password,
        confirm_password: this.form.confirm_password,
        token: this.$route?.query?.token,
      }

      this.response = {
        loading: true,
        message: '',
      }
      const { resetPassword } = AuthService;
      await resetPassword(payload)
        .then(() => {
          this.$emit('passwordChanged');
        })
        .catch(error => {
          const { getMessage } = Messages;
          const code = error.response?.data?.error;
          this.response.message = getMessage(code);
        }).finally(() => { this.response.loading = false; })
    }
  },

  components: {
    Form, Field, Message,
  },
}
</script>

<style lang="scss" scoped></style>