<template>
  <div class="card card-horizontal d-xs-block d-sm-none">
    <a href="#" class="no-decoration" @click.prevent>
      <div class="row g-0">
        <div class="col-5">
          <img class="card-img-top" width="100%" :src="'https://via.placeholder.com/600/d1212'" alt="Title" />
        </div>
        <div class="col-7 border">
          <div class="card-body">
            <p class="card-title "><span class="small fw-semibold">{{ product.name }}</span></p>
            <p class="card-text">R$ <span class="text-danger">{{ product.newValue }}</span> <span
                class="text-decoration-line-through">{{ product.oldValue }}</span>
            </p>
          </div>
        </div>
      </div>
    </a>
  </div>
</template>

<script>
export default {
  props: {
    product: {
      type: Object,
      default: () => ({}),
    },
  },
}
</script>

<style lang="scss" scoped>
.card-horizontal {
  &:hover {
    border-color: $red;
    transform: scale(1.01);
    transition: 0.5s ease-in-out;
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