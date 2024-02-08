<template>
  <div>
    <Breadcrumb class="my-5">
      <template v-slot:list>
        <li class="breadcrumb-item"><a href="/">Pagina Inicial</a></li>
        <li class="breadcrumb-item active ">Carrinho</li>
      </template>
    </Breadcrumb>


    <div class="d-flex gap-3">
      <div style="flex:7.5;" class="shadow-sm rounded p-3">
        <template v-if="products.length > 0">
          <div class="row p-1 mx-0 my-2 flex-nowrap" v-for="(product, index) in products" :key="product.name">
            <div class="col-1 m-0 p-0">
              <img :src="product.image" :alt="'image' + index" class="w-100">
            </div>
            <div class="col-7">
              <p class="small text-secondary mb-0">{{ product.brand }}</p>
              <a class="link-name fw-semibold small text-dark" :href="'produto/' + product.slug">
                {{ product.name }}
              </a>
              <div class="d-flex text-secondary flex-column mt-2 text-small">
                <p class="m-0"> Com desconto no PIX: <span class="fw-bold">{{ toBRL(product.priceDiscount) }}</span></p>
                <p>Parcelado no cartão em até 10x sem juros: <span class="fw-bold"> {{ toBRL(product.priceInstalment)
                }}</span></p>
              </div>
            </div>
            <div class="col-4">

              <div class="d-flex flex-row">
                <div class="d-flex flex-column">

                  <div class="d-flex flex-column">
                    <label :for="'idQty' + index" class="form-label small text-center w-100">Quant.</label>
                    <div class="d-flex">
                      <button class="btn-none p-0" @click.prevent.stop="decrementProductInCart(product.slug)">
                        <i class="bi bi-arrow-left-short fs-4 text-danger"></i>
                      </button>
                      <div style="width: 70px;">
                        <input :id="'idQty' + index" type="text" class="form-control w-100 text-center form-control-sm"
                          v-model="product.qty" v-mask="'##'" @blur="blurQtyProducts(product.slug)">
                      </div>
                      <button class="btn-none p-0" @click.prevent.stop="incrementProductInCart(product.slug)">
                        <i class="bi bi-arrow-right-short fs-4 text-danger "></i>
                      </button>
                    </div>
                  </div>

                  <div class="mt-2">
                    <button class="btn-none text-danger fw-bold __web-inspector-hide-shortcut__"
                      @click.prevent.stop="deleteProductInCart(product.slug)">
                      <i class="bi bi-trash"></i>
                      <span class="small ms-2">Remover</span>
                    </button>
                  </div>
                </div>

                <div class="w-100">
                  <div>
                    <p class="small text-end">Preço à vista no PIX:</p>
                    <p class="fw-semibold text-danger text-end">{{ toBRL(product.priceDiscount) }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </template>
        <template v-else>
          <h5 class="mt-2 alert alert-warning">Sem produtos no carrinho</h5>
        </template>

      </div>
      <div class="shadow-sm rounded sticky-top h-100" style="flex:2.5; ">
        <div>

          <div class="mb-3 px-3">
            <i class="bi bi-file-spreadsheet fs-5 text-danger"></i>
            <span class="fw-bold ms-2">RESUMO</span>
          </div>

          <div class="px-2">
            <div class="d-flex px-1">
              <span class="small text-secondary">Valor dos Produtos:</span>
              <span class="fw-bold ms-auto">{{ toBRL($data.totalProducts) }}</span>
            </div>
          </div>

          <div class="border-bottom m-2"></div>

          <div class="my-3 px-2">
            <div class="d-flex px-1">
              <span class="small text-secondary">Frete:</span>
              <span class="fw-bold ms-auto">{{ toBRL($data.freight) }}</span>
            </div>
          </div>
          <div class="my-3 px-2">
            <div class="d-flex align-items-center">
              <span class="small text-secondary">Total á prazo:</span>
              <span class="fw-bold ms-auto">{{ toBRL($data.total) }}</span>
            </div>
            <div class="font-small text-secondary text-center mt-2">(em até <span class="fw-bold">10x</span> de <span
                class="fw-bold">{{
                  toBRL($data.total / 10) }} sem juros) </span>
            </div>
          </div>

          <div class="bg-light mx-3 my-3 py-2">
            <div class="px-1 d-flex flex-column align-items-center">
              <span class="small">Valor à vista no <b>Pix</b>:</span>
              <p class="m-0 h4 my-2 fw-semibold text-danger">{{ toBRL($data.totalDiscount) }}</p>
              <span class="small">(Economize: <b>{{ toBRL($data.diffDiscount) }}</b> )</span>
            </div>
          </div>

          <div class="px-3 mb-3">
            <button class="w-100 btn btn-danger ">IR PARA PAGAMENTO</button>
          </div>

        </div>
      </div>
    </div>
  </div>

</template>

<script>
import Breadcrumb from '../utils/Breadcrumb.vue';
import FunctionsHelper from '../../utils/FunctionsHelper';
import { mask } from 'vue-the-mask';
export default {
  data() {
    const { toBRL } = FunctionsHelper;
    return {
      toBRL,
      currentSlugProduct: null,
      totalProducts: 1392.79,
      freight: 5,
      total: 1395.79,
      totalDiscount: 1179.79,
      diffDiscount: 198.0,
      products: [

        {
          image: 'https://via.placeholder.com/100/92c952',
          name: 'Placa de Video ZOTAC GTX 1660 6GB Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum voluptas officiis asperiores natus? Laudantium modi assumenda non cupiditate. Facere, mollitia. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolorum voluptas officiis asperiores natus? Laudantium modi assumenda non cupiditate. Facere, mollitia.',
          slug: 'placa-de-video-zotac-gtx-1660-gb',
          brand: 'Zotac',
          priceDiscount: 989.90,
          priceInstalment: 989.90 + 989.90 * 0.05,
          qty: 1,
          max: 5,

        },
        {
          image: 'https://via.placeholder.com/100/9sdhg',
          name: 'Memoria Ram ATERMITER 8GB 3200 Mhz',
          slug: 'memoria-ram-atermiter-8gb-3200-mhz',
          brand: 'Atermiter',
          priceDiscount: 179.99,
          priceInstalment: 179.99 + 179.99 * 0.05,
          qty: 1,
          max: 10,
        },
        {
          image: 'https://via.placeholder.com/100/a1212',
          name: 'SSD M.2 NVME 512GB Kingspec',
          slug: 'ssd-m2-nvme-512gb-kingspec',
          brand: 'Kingspec',
          priceDiscount: 229.90,
          priceInstalment: 246.00,
          qty: 1,
          max: 10,
        },
      ],
    }
  },
  methods: {

    blurQtyProducts(slug) {
      this.currentSlugProduct = slug;
      const idx = this.getIndexProduct;
      this.products[idx].qty = this.products[idx].qty > this.products[idx].max ? this.products[idx].max : this.products[idx].qty;
    },
    decrementProductInCart(slug) {
      this.currentSlugProduct = slug;
      const idx = this.getIndexProduct;
      this.products[idx].qty > 1 ? (this.products[idx].qty--) : '';
    },
    incrementProductInCart(slug) {
      this.currentSlugProduct = slug;
      const idx = this.getIndexProduct;
      this.products[idx].qty < this.products[idx].max ? (this.products[idx].qty++) : '';

    },
    deleteProductInCart(slug) {
      this.currentSlugProduct = slug;
      const idx = this.getIndexProduct;
      this.products.splice(idx, 1);
    }
  },

  computed: {
    getIndexProduct() {
      return this.products.findIndex(p => p.slug === this.currentSlugProduct);
    },
  },

  components: { Breadcrumb },
  directives: {
    mask,
  }
}
</script>

<style lang="scss" scoped>
.link-name {
  text-decoration: none;

  font-size: clamp(12px, 3vw, 14px);

  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 2;

  &:hover {
    text-decoration: underline;
  }
}

.text-small {
  font-size: 12px;

}
</style>