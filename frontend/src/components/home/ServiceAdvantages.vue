<template>
  <HeaderSection :headerSection="headerSection" class="mb-4" />
  <div class="row d-none d-lg-flex">
    <div class="col-4 text-center">
      <i class="bi bi-truck fs-2"></i>
      <p class="fs-6 fw-bold">Frete Grátis</p>
      <p class="small text-secondary">Frete gratis para pedidos acima de R$ 140,00</p>
    </div>
    <div class="col-4 text-center">
      <i class="bi bi-headset fs-2"></i>
      <p class="fs-6 fw-bold">Atendimento ao Cliente 24 horas</p>
      <p class="small text-secondary">Suporte ao cliente 24 horas por dia</p>
    </div>
    <div class="col-4 text-center ">
      <i class="bi bi-shield-check fs-2"></i>
      <p class="fs-6 fw-bold">Garantia De Devolução De Dinheiro</p>
      <p class="small text-secondary">Reembolso completo se não estiver satisfeito</p>
    </div>
  </div>

  <div class="row d-lg-none">
    <Accordion :id="accordionId">
      <template v-slot:accordion-item>
        <AccordionItem :id="accordionId">
          <template v-slot:header>
            <div class="d-flex align-items-center gap-2">
              <i class="bi bi-truck fs-2"></i>
              <span class="fs-6 fw-bold">Frete Grátis</span>
            </div>
          </template>
          <template v-slot:body>
            <p class="small text-secondary">Frete gratis para pedidos acima de R$ 140,00</p>
          </template>
        </AccordionItem>
        <AccordionItem :id="accordionId">
          <template v-slot:header>
            <div class="d-flex align-items-center gap-2">
              <i class="bi bi-headset fs-2"></i>
              <span class="fs-6 fw-bold">Atendimento ao Cliente 24 horas</span>
            </div>
          </template>
          <template v-slot:body>
            <p class="small text-secondary">Suporte ao cliente 24 horas por dia</p>
          </template>
        </AccordionItem>
        <AccordionItem :id="accordionId">
          <template v-slot:header>
            <div class="d-flex align-items-center gap-2">
              <i class="bi bi-shield-check fs-2"></i>
              <span class="fs-6 fw-bold">Garantia De Devolução De Dinheiro</span>
            </div>
          </template>
          <template v-slot:body>
            <p class="small text-secondary">Reembolso completo se não estiver satisfeito</p>
          </template>
        </AccordionItem>
      </template>
    </Accordion>
  </div>
</template>

<script>
import Accordion from '../utils/Accordion.vue';
import AccordionItem from '../utils/AccordionItem.vue';
import HeaderSection from '../utils/HeaderSection.vue';

export default {
  data() {
    return {
      headerSection: {
        name: 'Soluções e Suporte',
      },
      accordionId: 'accordionServices'
    }
  },
  components: {
    HeaderSection, Accordion, AccordionItem
  },
}
</script>

<style lang="scss" scoped></style>