<template>
  <div>
    <p class="fs-5 text-danger">Meus Pedidos</p>
    <div v-for="(order, index) in orders" :key="index" class="border rounded p-3 mb-4">
      <div class="d-flex justify-content-end">
        <span>Rastreio</span> |
        <span>FINALIZADO</span>
      </div>
      <hr>
      <CardOrder v-for="(itemOrder, idx) in order.orders " :key="idx" :order="itemOrder" class="p-2"
        :class="{ 'border-bottom': idx < order.orders.length - 1 }" />
      <hr>
      <div class="text-end mt-3 ">
        <span class="small">Total do pedido: </span>
        <span class="fs-4 ms-1">R$ {{ order.totalOrder }}</span>
      </div>

    </div>


  </div>
</template>

<script>
import CardOrder from '../utils/CardOrder.vue';

export default {
  data() {
    return {
      orders: [
        {
          idOrder: 18771187,
          date: '31/07/2016',
          totalOrder: 69.90,
          expected: 'Aguardando Pagamento',
          orders: [
            {
              img: 'https://via.placeholder.com/600/d1212',
              price: 14.33,
              name: 'quaerat quae fugit perspiciatis voluptatem distinctio fugiat minima, repellat',
              qty: 3,
            },
            {
              img: 'https://via.placeholder.com/600/d1212',
              price: 54.10,
              name: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, commodi facere.',
              qty: 1,
            }
          ]
        },
        {
          idOrder: 18771187,
          date: '31/07/2016',
          totalOrder: 449.90,
          expected: 'Aguardando Pagamento',
          orders: [
            {
              img: 'https://via.placeholder.com/600/d1345',
              price: 45.33,
              name: 'quaerat quae fugit perspiciatis voluptatem distinctio fugiat minima, repellat',
              qty: 5,
            },
            {
              img: 'https://via.placeholder.com/600/d1444',
              price: 109.00,
              name: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, commodi facere.',
              qty: 1,
            }
          ]
        },
      ],

    };
  },
  components: { CardOrder }
}
</script>

<style lang="scss" scoped></style>