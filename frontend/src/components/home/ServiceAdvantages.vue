<template>
  <HeaderSection :headerSection="headerSection" class="mb-3" />
  <div class="row  text-center w-100 p-1 ">
    <div class="col d-none d-lg-block">
      <i class="bi bi-truck fs-2"></i>
      <p class="fs-6 fw-bold">Frete Grátis</p>
      <p class="small text-secondary">Frete gratis para pedidos acima de R$ 140,00</p>
    </div>
    <div class="col d-none d-lg-block">
      <i class="bi bi-headset fs-2"></i>
      <p class="fs-6 fw-bold">Atendimento ao Cliente 24 horas</p>
      <p class="small text-secondary">Suporte ao cliente 24 horas por dia</p>
    </div>
    <div class="col d-none d-lg-block ">
      <i class="bi bi-shield-check fs-2"></i>
      <p class="fs-6 fw-bold">Garantia De Devolução De Dinheiro</p>
      <p class="small text-secondary">Reembolso completo se não estiver satisfeito</p>
    </div>

    <div class="accordion p-0 d-lg-none" id="accordionExample">

      <div class="accordion-item">
        <div class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            <div class="d-flex align-items-center gap-2">
              <i class="bi bi-truck fs-2 ps-1"></i>
              <span class="fs-6 fw-bold">Frete Grátis</span>
            </div>
          </button>
        </div>
        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <p class="text-secondary">Frete gratis para pedidos acima de R$ 140,00</p>
          </div>
        </div>
      </div>

      <div class="accordion-item ">
        <div class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <div class="d-flex gap-2 align-items-center">
              <i class="bi bi-headset fs-2"></i>
              <span class="fs-6 fw-bold">Atendimento ao Cliente 24 horas</span>
            </div>
          </button>
        </div>
        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <p class="text-secondary">Suporte ao cliente 24 horas por dia</p>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            <div class="d-flex gap-2 align-items-center">
              <i class="bi bi-shield-check fs-2"></i>
              <span class="fs-6 fw-bold">Garantia De Devolução De Dinheiro</span>
            </div>
          </button>
        </div>
        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <p class="text-secondary">Reembolso completo se não estiver satisfeito</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import HeaderSection from '../utils/HeaderSection.vue';

export default {
  data() {
    return {
      headerSection: {
        name: 'Soluções e Suporte',
      }
    }
  },
  components: {
    HeaderSection,
  },
}
</script>

<style lang="scss" scoped></style>