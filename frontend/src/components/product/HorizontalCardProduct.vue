<template>
  <div class="card card-horizontal d-xs-block d-sm-none">
    <a href="#" class="no-decoration" @click.prevent>
      <div class="row g-0">

        <div class="col-5">
          <img class="card-img-top" width="100%" :src="'https://via.placeholder.com/600/d1212'" alt="Title" />
        </div>
        <div class="col-7 mb-1">
          <div class="card-body pt-0">
            <div class="justify-content-end mb-1">
              <IconsCard />
            </div>
            <p class="card-title mb-1 "><span class="small fw-semibold">{{ product.name }}</span></p>
            <p class=" mb-1 card-text d-flex flex-nowrap align-items-center" style="height:30px;">
              <span class="small text-danger">R$</span> <span class="text-danger fst-italic me-3 ms-1">
                {{ product.newValue }}
              </span>
              <span class="small text-secondary">R$</span> <span
                class=" small text-decoration-line-through ms-1 text-secondary"> {{ product.oldValue }}</span>
            </p>
            <div class="card-text">
              <RatingProduct :rating="rating" />
            </div>

          </div>
        </div>
      </div>
      <a href="#" class="w-100 btn btn-sm btn-dark mt-1">Comprar</a>
    </a>
  </div>
</template>

<script>
// @ts-ignore
import IconsCard from './IconsCard.vue';
import RatingProduct from './RatingProduct.vue';

export default {
  props: {
    product: {
      type: Object,
      default: () => ({}),
    },
  },
  data() {
    return {
      rating: 3.5
    };
  },
  components: { RatingProduct, IconsCard }
}
</script>

<style lang="scss" scoped>
.card-horizontal {
  &:hover {
    border-color: $red;
    transform: scale(1.01);
    // transition: 0.5s ease-in-out;
  }

  .no-decoration {
    text-decoration: none;
    color: black;
  }

  .card-img-top {
    height: 100%;
  }

  .card-title {
    height: 70px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
  }

  min-width: 290px;
  width: 100%;
  // max-height: 400px;
  // min-height: 400px;

}
</style>