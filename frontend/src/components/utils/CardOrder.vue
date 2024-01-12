<template>
  <div>
    <div class="d-flex">
      <div class="border img-order ">
        <img :src="order.img" :alt="'imageProduct' + order.idOrder" class="img-fluid">
      </div>
      <div class="row ms-1 flex-grow-1">
        <div class="col-md-10">
          <span class="text-secondary text-limit ">
            {{ order.name }}
          </span>
          <span class="small">x{{ order.qty }}</span>
        </div>
        <div class="col-md-2 ">
          R$ <span class="text-danger">{{ order.price }}</span>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
export default {
  props: {
    order: {
      type: Object,
      default: {},
      required: true,
    },
  },
}
</script>

<style lang="scss" scoped>
.img-order {

  min-height: 82px;
  min-width: 82px;

  max-height: 100px;
  max-width: 100px;
  width: 100%;
  height: 100%;
}

.text-limit {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.text-reponsive{
}
</style>