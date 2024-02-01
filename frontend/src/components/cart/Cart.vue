<template>
  <div>
    <Breadcrumb class="my-5 my-5">
      <template v-slot:list>
        <li class="breadcrumb-item"><a href="/">Pagina Inicial</a></li>
        <li class="breadcrumb-item active ">Carrinho</li>
      </template>
    </Breadcrumb>

    <div class="row">
      <div class="col">
        <table class="table table-borderless">
          <thead>
            <tr class="shadow-sm">
              <th>Produto</th>
              <th>Preço</th>
              <th>Quantidade</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
          
          </tbody>
        </table>
      </div>
    </div>



  </div>
</template>

<script>
import Breadcrumb from '../utils/Breadcrumb.vue';

export default {
  data() {
    return {
      products:[
      {
        image:'https://via.placeholder.com/100/92c952',
        name: 'Placa de Video'
      }
      ],
    }
  },
  components: { Breadcrumb }
}
</script>

<style lang="scss" scoped></style>