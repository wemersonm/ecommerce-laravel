<template>
  <div>
    <Breadcrumb class="my-5 my-5">
      <template v-slot:list>
        <li class="breadcrumb-item"><a href="/">Pagina Inicial</a></li>
        <li class="breadcrumb-item active ">Carrinho</li>
      </template>
    </Breadcrumb>

    <div class="row border">
      <div class="col-9 border border-danger">
        produtos
      </div>
      <div class="col-3 border border-success position-fixed ">
        <h1>resumo dos valores</h1>
      </div>
    </div>


    <h1>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, dicta dignissimos quos obcaecati eaque in. Sequi
      commodi tempora obcaecati accusantium, nulla, alias saepe optio quisquam, quidem ex quas illum aut?
      Vero eligendi ducimus consequuntur minima eaque magni assumenda itaque, tempore illo! Laboriosam cumque id mollitia
      quisquam, saepe vitae commodi tempora officia. Pariatur laboriosam odit totam animi nulla ipsum porro
      exercitationem!
      Doloremque eius explicabo vitae error temporibus tempora reprehenderit similique veritatis recusandae eum, enim
      sequi est ad, asperiores nesciunt quibusdam. Modi mollitia, nobis omnis expedita reiciendis hic vero consequuntur ea
      repudiandae!
      A corrupti suscipit expedita! Deserunt eius eos eaque perspiciatis! Praesentium quisquam suscipit aperiam ratione
      consequatur maxime tenetur perferendis, molestias laborum, consequuntur vitae vero debitis itaque! Consectetur nulla
      veniam consequatur quos?</h1>
    <h1>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, dicta dignissimos quos obcaecati eaque in. Sequi
      commodi tempora obcaecati accusantium, nulla, alias saepe optio quisquam, quidem ex quas illum aut?
      Vero eligendi ducimus consequuntur minima eaque magni assumenda itaque, tempore illo! Laboriosam cumque id mollitia
      quisquam, saepe vitae commodi tempora officia. Pariatur laboriosam odit totam animi nulla ipsum porro
      exercitationem!
      Doloremque eius explicabo vitae error temporibus tempora reprehenderit similique veritatis recusandae eum, enim
      sequi est ad, asperiores nesciunt quibusdam. Modi mollitia, nobis omnis expedita reiciendis hic vero consequuntur ea
      repudiandae!
      A corrupti suscipit expedita! Deserunt eius eos eaque perspiciatis! Praesentium quisquam suscipit aperiam ratione
      consequatur maxime tenetur perferendis, molestias laborum, consequuntur vitae vero debitis itaque! Consectetur nulla
      veniam consequatur quos?</h1>
    <h1>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, dicta dignissimos quos obcaecati eaque in. Sequi
      commodi tempora obcaecati accusantium, nulla, alias saepe optio quisquam, quidem ex quas illum aut?
      Vero eligendi ducimus consequuntur minima eaque magni assumenda itaque, tempore illo! Laboriosam cumque id mollitia
      quisquam, saepe vitae commodi tempora officia. Pariatur laboriosam odit totam animi nulla ipsum porro
      exercitationem!
      Doloremque eius explicabo vitae error temporibus tempora reprehenderit similique veritatis recusandae eum, enim
      sequi est ad, asperiores nesciunt quibusdam. Modi mollitia, nobis omnis expedita reiciendis hic vero consequuntur ea
      repudiandae!
      A corrupti suscipit expedita! Deserunt eius eos eaque perspiciatis! Praesentium quisquam suscipit aperiam ratione
      consequatur maxime tenetur perferendis, molestias laborum, consequuntur vitae vero debitis itaque! Consectetur nulla
      veniam consequatur quos?</h1>

  </div>
</template>

<script>
import Breadcrumb from '../utils/Breadcrumb.vue';

export default {
  data() {
    return {
      products: [
        {
          image: 'https://via.placeholder.com/100/92c952',
          name: 'Placa de Video'
        }
      ],
    }
  },
  components: { Breadcrumb }
}
</script>

<style lang="scss" scoped></style>