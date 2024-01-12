<template>
  <div>
    <p class="fs-5 text-danger">Meus Pedidos</p>

    <div class="card mb-4" v-for="(order, index) in   orders  " :key="index">
      <div class="card-header d-flex ">
        <span :class="{ 'fw-bold me-auto': true }">N° do pedido {{ order.idOrder }}</span>
        <div class=" d-flex justify-content-end gap-2">
          <span :class="{ 'd-none d-md-block': true, }" :style="[style.tracking, style.fontSize]">{Ultimo rastreio}</span>
          <div class="border-end d-none d-md-block"></div>
          <span class="text-danger d-none d-md-block">{status do pedido}</span>
        </div>
      </div>

      <div class="card-body">
        <CardOrder v-for="(  itemOrder, idx  ) in   order.orders   " :key="idx" :order="itemOrder"
          :class="{ 'py-2': true, 'border-bottom': idx < order.orders.length - 1 }" />
      </div>
      <div class="card-text d-md-none border-top">
        <span :style="[style.tracking, style.fontSize]">{Ultimo rastreio}</span>
        <div class="border-bottom"></div>
        <span class="text-danger" :style="style.fontSize">{status do pedido}</span>
      </div>
      <div class="card-footer d-flex">
        <div class="ms-auto">
          <span class="text-secondary small">Total do pedido: </span>
          <span class="text-danger resposive-font fw-bold">R$ {{ order.totalOrder }}</span>
        </div>
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
              name: 'quaerat quae fugit perspiciatis voluptatem distinctio fugiat minima, repellat',
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
      style: {
        tracking: 'color: #00994C !important;',
        fontSize: 'font-size: clamp(14px,3vw,16px);',
      }
    };
  },
  components: { CardOrder }
}
</script>

<style lang="scss" scoped>
.card-footer {
  background-color: #fff;

  .resposive-font {
    font-size: clamp(17px, 4vw, 20px);

  }
}
</style>