<template>
  <div>
    <Form @submit="addAddress" v-slot="{ errors }">
      <div class="form-floating mb-3">
        <Field type="text" name="title" :class="{ 'form-control': true, 'is-invalid': errors['title'] }"
          id="floatingTitle" placeholder="*******" rules="required|min:6|max:32" v-model="password_confirm" />
        <label for="floatingTitle">Titulo</label>
        <div id="titleHelp" class="form-text">Exemplo: Minha casa</div>

        <div class="invalid-feedback"> {{ errors['password'] }}</div>
      </div>
      <div class="d-flex gap-3">
        <button class="btn btn-sm btn-danger w-100 my-3" @click.prevent.stop="closeModal">
          Cancelar
        </button>
        <button class="btn btn-sm btn-secondary w-100 my-3" type="submit">
          <span class="spinner-grow spinner-grow-sm" v-if="response.loading" v-for="i in 3" :key="i"
            aria-hidden="true"></span>
          <span role="status" v-if="!response.loading">Confirmar</span>
        </button>
      </div>
    </Form>
  </div>
</template>

<script>
import validations from '../../plugins/vee-validate.js';
const { Form, Field } = validations;
export default {
  data() {
    const { required, max, min } = validations;
    return {
      required, max, min,
      response: {
        loading: false,
      },
      form: {
        title: '',
        street: '',
        number: '',
        complement: '',
        neighborhood: '',
        city: '',
        state: '',
        zipcode: '',
        active: false,
      }
    }
  },
  methods: {
    addAddress() {
      alert('Add address');
    }
  },
  components: {
    Form, Field,
  },

}
</script>

<style lang="scss" scoped></style>