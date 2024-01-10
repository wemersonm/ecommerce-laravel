<template>
  <Breadcrumb>
    <template v-slot:list>
      <li class="breadcrumb-item"><a href="/">Pagina Inicial</a></li>
      <li class="breadcrumb-item active">Minha Conta</li>
    </template>
  </Breadcrumb>
  <div class="row  p-1">
    <div class="col-3  h-100">
      <MenuAccount />
    </div>
    <div class="col-9 rounded shadow p-4">
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

<style lang="scss" scoped>

</style>