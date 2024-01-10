<template>
  <div>
    <Form @submit="addAddress" v-slot="{ errors }">

      <div class="form-floating mb-3">
        <Field type="text" name="title" :class="{ 'form-control': true, 'is-invalid': errors['title'] }"
          id="floatingTitle" placeholder="" rules="required|min:6|max:32" v-model="form.title" />
        <label for="floatingTitle">Titulo</label>
        <div id="titleHelp small" class="form-text" v-if="!errors['title']">Exemplo: Minha casa</div>
        <div class="invalid-feedback"> {{ errors['title'] }}</div>
      </div>

      <div class="form-floating mb-3">
        <Field name="typeAddress" as="select" v-model="form.type" id="floatingTypeAddress"
          :rules="{ one_of: [1, 2, 3], required: true }"
          :class="{ 'form-select': true, 'text-secondary': form.type == -1, 'is-invalid': errors['typeAddress'] }">
          <option value="-1" disabled selected>Selecione o tipo de endereço</option>
          <option value="1">Residencial</option>
          <option value="2">Comercial</option>
          <option value="3">Outro</option>
        </Field>
        <label for="floatingTypeAddress">Tipo de endereço</label>
        <div class="invalid-feedback"> {{ errors['typeAddress'] }}</div>
      </div>

      <div class="form-floating mb-3">
        <Field type="text" name="recipient" :class="{ 'form-control': true, 'is-invalid': errors['recipient'] }"
          id="floatingRecipient" placeholder="" rules="required|min:4|max:180" v-model="form.recipient" />
        <label for="floatingRecipient">Destinatário</label>
        <div id="titleHelp small" class="form-text" v-if="!errors['recipient']">Nome e sobrenome da pessoa que irá receber
        </div>
        <div class="invalid-feedback"> {{ errors['recipient'] }}</div>
      </div>

      <div class="form-floating mb-3">
        <Field type="text" name="cep" :class="{ 'form-control': true, 'is-invalid': errors['cep'] }" id="floatingCep"
          rules="required|min:4|max:180" v-model="form.zipcode" v-mask="'#####-###'" @blur="searchCEP" placeholder="" />
        <label for="floatingCep">Informe o CEP</label>
        <div id="titleHelp small" class="form-text" v-if="!errors['cep']">Exemplo: 99999-999</div>
        <div class="invalid-feedback"> {{ errors['cep'] }}</div>
      </div>

      <div class="row">
        <div class="col-8">
          <div class="form-floating mb-3">
            <Field type="text" name="street" :class="{ 'form-control': true, 'is-invalid': errors['street'] }"
              id="floatingStreet" rules="required|min:1|max:200" v-model="form.street" placeholder="" />
            <label for="floatingStreet">Rua</label>
            <div class="invalid-feedback"> {{ errors['street'] }}</div>
          </div>
        </div>
        <div class="col-4">
          <div class="form-floating mb-3">
            <Field type="text" name="number" :class="{ 'form-control': true, 'is-invalid': errors['number'] }"
              id="floatingNumber" rules="required" v-model="form.number" placeholder="" />
            <label for="floatingNumber">Número</label>
            <div class="invalid-feedback"> {{ errors['number'] }}</div>
          </div>
        </div>
      </div>

      <div class="form-floating mb-3">
        <Field type="text" name="complement" :class="{ 'form-control': true, 'is-invalid': errors['complement'] }"
          id="floatingComplement" rules="max:200" v-model="form.complement" placeholder="" />
        <label for="floatingComplement">Complemento (opcional)</label>
        <div id="titleHelp small" class="form-text" v-if="!errors['complement']">Exemplo: apartamento 123, bloco ABC
        </div>
        <div class="invalid-feedback"> {{ errors['complement'] }}</div>
      </div>

      <div class="form-floating mb-3">
        <Field type="text" name="neighborhood" :class="{ 'form-control': true, 'is-invalid': errors['neighborhood'] }"
          id="floatingNeighborhood" rules="required|max:200" v-model="form.neighborhood" placeholder="" />
        <label for="floatingNeighborhood">Bairro</label>
        <div class="invalid-feedback"> {{ errors['neighborhood'] }}</div>
      </div>

      <div class="row">
        <div class="col-7">
          <div class="form-floating mb-3">
            <Field type="text" name="city" :class="{ 'form-control': true, 'is-invalid': errors['city'] }"
              id="floatingCity" rules="required|max:200" v-model="form.city" placeholder="" />
            <label for="floatingCity">Cidade</label>
            <div class="invalid-feedback"> {{ errors['city'] }}</div>
          </div>
        </div>
        <div class="col-5">
          <div class="form-floating mb-3">
            <Field name="state" as="select" v-model="form.state" id="floatingState"
              :rules="{ not_one_of: [-1], required: true }"
              :class="{ 'form-select': true, 'text-secondary': form.state == -1, 'is-invalid': errors['state'] }">
              <option value="-1" disabled selected>Selecione</option>
              <option value="AC">Acre</option>
              <option value="AL">Alagoas</option>
              <option value="AP">Amapá</option>
              <option value="AM">Amazonas</option>
              <option value="BA">Bahia</option>
              <option value="CE">Ceará</option>
              <option value="DF">Distrito Federal</option>
              <option value="ES">Espírito Santo</option>
              <option value="GO">Goiás</option>
              <option value="MA">Maranhão</option>
              <option value="MT">Mato Grosso</option>
              <option value="MS">Mato Grosso do Sul</option>
              <option value="MG">Minas Gerais</option>
              <option value="PA">Pará</option>
              <option value="PB">Paraíba</option>
              <option value="PR">Paraná</option>
              <option value="PE">Pernambuco</option>
              <option value="PI">Piauí</option>
              <option value="RJ">Rio de Janeiro</option>
              <option value="RN">Rio Grande do Norte</option>
              <option value="RS">Rio Grande do Sul</option>
              <option value="RO">Rondônia</option>
              <option value="RR">Roraima</option>
              <option value="SC">Santa Catarina</option>
              <option value="SP">São Paulo</option>
              <option value="SE">Sergipe</option>
              <option value="TO">Tocantins</option>
            </Field>
            <label for="floatingState">Estado</label>
            <div class="invalid-feedback"> {{ errors['state'] }}</div>
          </div>

        </div>
      </div>

      <div class="form-floating mb-3">
        <Field type="text" name="reference" :class="{ 'form-control': true, 'is-invalid': errors['reference'] }"
          id="floatingNeighborhood" rules="max:200" v-model="form.reference" placeholder="" />
        <label for="floatingNeighborhood">Ponto de referência (opcional)</label>
        <div id="titleHelp small" class="form-text" v-if="!errors['reference']">Lugar próximo pra facilitar a localização
          do endereço
        </div>
        <div class="invalid-feedback"> {{ errors['reference'] }}</div>
      </div>

      <div class="form-check">
        <Field name="terms" type="checkbox">
          <label>
            <input type="checkbox" name="terms" id="checkboxActive" v-model="form.active" class="form-check-input" />
            <span class="form-check-label" for="checkboxActive">Este é meu endereço principal</span>
          </label>
        </Field>
      </div>
      <div class="d-flex gap-3 justify-content-end my-4">
        <span class="text-center  align-self-center" @click.prevent.stop="$emit('cancel')" style="cursor:pointer;">
          Cancelar
        </span>
        <button class="btn btn-sm btn-danger py-2 px-3" type="submit">
          <span class="spinner-grow spinner-grow-sm" v-if="response.loading" v-for="i in 3" :key="i"
            aria-hidden="true"></span>
          <span role="status" v-if="!response.loading">Adicionar</span>
        </button>
      </div>
    </Form>
  </div>
</template>

<script>
import validations from '../../plugins/vee-validate.js';
import { mask } from 'vue-the-mask'
const { Form, Field } = validations;
export default {
  emits: ['cancel'],
  data() {
    const { required, max, min, one_of, not_one_of } = validations;
    return {
      required, max, min, one_of, not_one_of,
      response: {
        loading: false,
      },
      form: {
        title: '',
        recipient: '',
        street: '',
        number: '',
        complement: '',
        neighborhood: '',
        city: '',
        state: '-1',
        zipcode: '',
        reference: '',
        active: false,
        type: -1,

      }
    }
  },
  methods: {
    addAddress() {
      alert('Add address');
    },
    searchCEP() {
      alert('CEP');
    }
  },
  components: {
    Form, Field,
  },
  directives: { mask },

}
</script>

<style lang="scss" scoped></style>