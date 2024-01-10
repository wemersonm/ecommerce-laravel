<template>
  <div>
    <div class="row">
      <div class="col-2">
        <img :src="order.img" :alt="'imageProduct' + order.idOrder" class="img-fluid img-order">
      </div>
      <div class="col-8">
        <span>
          {{ order.name }}
        </span><br>
        <span class="small">x{{ order.qty }}</span>
      </div>
      <div class="col-2">
        R$ {{ order.price }}

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
  max-width: 100px;
  max-height: 100%;
  width: 100%;
  height: 100%;
}
</style>