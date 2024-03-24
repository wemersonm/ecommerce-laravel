<template>
  <div class="card">
    <div class="card-body">
      <div class="card-title d-flex align-items-center">
        <span class="font-responsive fw-semibold me-auto">{{ address.title }}</span>
        <span class="badge text-bg-warning " v-if="address.active">Principal</span>
      </div>
      <div class="small text-secondary">
        <p class="card-text">{{ address.street }}, {{ address.number }} - {{ address.complement }}</p>
        <p class="card-text">{{ address.neighborhood }}, {{ address.city }} - {{ address.state }} </p>
        <p class="card-text">CEP: {{ address.zipcode }}</p>
      </div>
      <div class="d-flex gap-4 mt-3">
        <a href="#" class="btn btn-sm btn-outline-danger">Excluir</a>
        <a href="#" class="btn btn-sm btn-outline-secondary">Editar</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    address: {
      type: Object,
      default: {},
      required: true,
    },
  },
}
</script>

<style lang="scss" scoped>
.font-responsive {
  font-size: calc(6px + 1vw);
}

@media screen and (max-width: 900px) {
  .font-responsive {
    font-size: calc(16px);
  }
}
</style>