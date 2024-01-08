<template>
  <div>
    <button type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#ConfirmPassword"
      ref="modalRef">

    </button>
    <ModalDefault id="ConfirmPassword">
      <template v-slot:modal-body>
        <form @submit.stop.prevent="getPassword">
          <input type="password">
          <button>Enviar</button>
        </form>
      </template>
    </ModalDefault>


    <div class="row justify-content-center mt-4">
      <div class="col-6">
        <Form class="w-100" v-slot="{ errors }" @submit="submitEdit">
          <div class="form-floating mb-3">
            <Field type="text" name="name" :class="{ 'form-control': true, 'is-invalid': errors['name'] }"
              id="floatingName" placeholder="Nome Completo" rules="required|min:5|max:100" v-model="data.name" />
            <label for="floatingName">Nome</label>
            <div class="invalid-feedback">{{ errors['name'] }}</div>

          </div>
          <div class="form-floating mb-3">
            <Field type="email" name="email" :class="{ 'form-control': true, 'is-invalid': errors['email'] }"
              id="floatingEmail" placeholder="name@example.com" rules="required|email" v-model="data.email" />
            <label for="floatingEmail">Email</label>
            <div class="invalid-feedback"> {{ errors['email'] }}</div>
          </div>


          <!-- <AuthMessage v-if="response.messageError" class="mt-3 text-center"
          style="padding: 1rem; padding-left: 0.5rem; font-size: 0.9em;">
          <template v-slot:message>{{ response.messageError }}</template>
        </AuthMessage> -->

          <div class="d-flex gap-3">
            <button class="btn btn-sm btn-danger w-100 my-3" @click.prevent.stop="$emit('cancel')">
              Cancelar
            </button>
            <button class="btn btn-sm btn-secondary w-100 my-3" type="submit">
              <span class="spinner-grow spinner-grow-sm" v-if="response.loading" v-for="i in 3" :key="i"
                aria-hidden="true"></span>
              <span role="status" v-if="!response.loading">Salvar Alterações</span>
            </button>
          </div>

        </Form>
      </div>
    </div>

  </div>
</template>

<script>
import validation from '../../plugins/vee-validate';
import ModalDefault from '../modal/ModalDefault.vue';
const { Form, Field } = validation;
export default {
  emits: ['cancel'],
  props: {
    data: {
      type: Object,
      default: {},
      required: true,
    },
  },
  data() {
    const { required, email, min, max } = validation;
    return {
      required, email, min, max,
      response: {
        loading: false,
      },
    }
  },
  methods: {
    submitEdit() {
      this.$refs.modalRef.click();
    },
    getPassword() {
      alert('pegado!!');
    },
  },

  components: {
    Form, Field, ModalDefault
  },

}
</script>

<style lang="scss" scoped></style>