<template>
  <Breadcrumb class="mb-5">
    <template v-slot:list>
      <li class="breadcrumb-item"><a href="/">Pagina Inicial</a></li>
      <li class="breadcrumb-item active">Minha Conta</li>
    </template>
  </Breadcrumb>
  <div class="row">
    <div class=" col-lg-3 h-100">
      <MenuAccount />
    </div>
    <div class=" col-lg-9 rounded shadow">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
// @ts-ignore
import Breadcrumb from '../utils/Breadcrumb.vue';
// @ts-ignore
import MenuAccount from './MenuAccount.vue';

export default {
  components: { Breadcrumb, MenuAccount }
}
</script>

<style lang="scss" scoped></style>