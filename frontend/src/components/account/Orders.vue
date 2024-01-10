<template>
  <div>
    <p class="fs-5 text-danger">Meus Pedidos</p>
    <div v-for="(item,index) in order" :key="index">
      <div class="d-flex justify-content-end">
        <span>Rastreio</span> |
        <span>FINALIZADO</span>
      </div>
      <CardOrder :order="order" class="p-2" />
    </div>

  </div>
</template>

<script>
import CardOrder from '../utils/CardOrder.vue';

export default {
  data() {
    return {
      order: [
        {
          idOrder: 18771187,
          date: '31/07/2016',
          totalOrder: 69.90,
          img: 'https://via.placeholder.com/600/d1212',
          expected: 'Aguardando Pagamento',
        },

      ]
    },
      components: { CardOrder }
  }
</script>

<style lang="scss" scoped></style>