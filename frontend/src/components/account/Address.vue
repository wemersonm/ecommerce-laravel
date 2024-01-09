<template>
  <div class="d-flex align-items-center border">
    <p class="fs-4 me-auto">Meus Endereços</p>
    <p class="d-flex align-items-center gap-1" @click.prevent.stop="formAddAddress">
      <i class="bi bi-plus-circle fs-4"></i>
      <span> Adicionar endereço</span>
    </p>
  </div>
  <template v-if="showAddresses">
    <div class="row">
      <div class="col-lg-6 col-12 my-2" v-for="(address, index) in addresses" :key="index">
        <CardAddress :address="address" />
      </div>
    </div>
  </template>

  <template v-if="showAddAddress">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <AddAddress />
      </div>
    </div>
  </template>
</template>

<script>
// @ts-ignore
import CardAddress from '../utils/CardAddress.vue';
import AddAddress from './AddAddress.vue';

export default {
  data() {
    return {
      showAddresses: true,
      showAddAddress: false,

      addresses: [
        {
          title: 'Minha casa',
          street: 'Rua dos Bobos',
          number: '0',
          complement: 'Qd 15 Lt 33',
          neighborhood: 'Jd dos Chapoados',
          city: 'Osasco ',
          state: "São Paulo",
          zipcode: '06268-200',
          active: true,
        },
        {
          title: 'Minha Loja',
          street: 'Rua das Flores',
          number: '123',
          complement: 'Casa 2',
          neighborhood: 'Vila Primavera',
          city: 'São Paulo',
          state: 'São Paulo',
          zipcode: '01234-567',
          active: false,
        },
        {
          title: 'Meu Apartamento',
          street: 'Avenida dos Girassóis',
          number: '789',
          complement: 'Bloco A, Ap. 101',
          neighborhood: 'Jardim das Rosas',
          city: 'Campinas',
          state: 'São Paulo',
          zipcode: '13000-001',
          active: false,
        }

      ]
    }
  },
  methods: {
    formAddAddress() {
      this.showAddresses = false;
      this.showAddAddress = true;
    }
  },
  components: { CardAddress, AddAddress }
}
</script>

<style lang="scss" scoped></style>