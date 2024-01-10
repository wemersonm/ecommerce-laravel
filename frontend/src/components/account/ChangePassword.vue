<template>
  <div>
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <Form @submit="changePassword" v-slot="{ errors }">
          <div class="form-floating mb-3">
            <Field type="password" name="current_password"
              :class="{ 'form-control': true, 'is-invalid': errors['current_password'] }" id="floatingCurrentPassword"
              placeholder="*******" rules="required|min:6|max:32" v-model="form.currentPassword" />
            <label for="floatingCurrentPassword">Senha Atual</label>
            <div class="invalid-feedback"> {{ errors['current_password'] }}</div>
          </div>

          <div class="form-floating mb-3">
            <Field type="password" name="password" :class="{ 'form-control': true, 'is-invalid': errors['password'] }"
              id="floatingPassword" placeholder="*******" rules="required|min:6|max:32" v-model="form.password" />
            <label for="floatingPassword">Nova Senha</label>
            <div class="invalid-feedback"> {{ errors['password'] }}</div>
          </div>

          <div class="form-floating mb-3">
            <Field type="password" name="confirm_password"
              :class="{ 'form-control': true, 'is-invalid': errors['confirm_password'] }" id="floatingConfirmPassword"
              placeholder="*******" rules="required|min:6|max:32|confirmed:@password" v-model="form.confirmPassword" />
            <label for="floatingConfirmPassword">Confirmar Nova Senha</label>
            <div class="invalid-feedback"> {{ errors['confirm_password'] }}</div>
          </div>
          <div class="d-flex gap-3 justify-content-end my-4">
            <span class="text-center  align-self-center" @click.prevent.stop="$emit('cancel')" style="cursor:pointer;">
              Cancelar
            </span>
            <button class="btn btn-sm btn-danger py-2 px-3" type="submit">
              <span class="spinner-grow spinner-grow-sm" v-if="response.loading" v-for="i in 3" :key="i"
                aria-hidden="true"></span>
              <span role="status" v-if="!response.loading">Confirmar</span>
            </button>
          </div>
        </Form>
      </div>
    </div>
  </div>
</template>

<script>
//@ts-ignore
import validation from '../../plugins/vee-validate';
const { Form, Field } = validation;
export default {
  emits: ['cancel'],
  data() {
    const { required, min, max, confirmed } = validation;
    return {
      required, min, max, confirmed,
      response: {
        loading: false,
      },
      form: {
        currentPassword: '',
        password: '',
        confirmPassword: '',
      }
    }
  },
  methods: {
    changePassword() {
      alert('password alterado !!!');
    }
  },
  components: {
    Form, Field
  },
}
</script>

<style lang="scss" scoped></style>