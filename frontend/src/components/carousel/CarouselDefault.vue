<template>
  <div>
    <div :id="id" class="carousel slide">
      <div class="carousel-indicators" v-if="indicators">
        <div>
          <button v-for="(item, index) in qtyItens" type="button" :data-bs-target="'#' + id" :data-bs-slide-to="index"
            class="active" aria-current="true" :aria-label="'Slide' + index"></button>
        </div>

      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="https://via.placeholder.com/500/921df" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="https://via.placeholder.com/500/sgga41" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="https://via.placeholder.com/500/dh24" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" :data-bs-target="'#' + id" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" :data-bs-target="'#' + id" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    id: {
      type: String,
      default: 'carousel' + Math.random() * 1000,
    },
    indicators: {
      type: Boolean,
      default: true
    },
    itens: {
      type: Array,
      default: {},
      required: true,
    }
  },
  data() {
    return {
      qtyItens: 0,
    }
  },
  created() {
    this.qtyItens = props.itens.lenght;
  },
}
</script>

<style lang="scss" scoped></style>