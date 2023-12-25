<template>
  <div class="offcanvas-header">
    <div class="d-flex w-100 ">
      <h5 class="offcanvas-title flex-grow-1" id="offcanvasWithBothOptionsLabel">Olá, {{ authStore.getNameUser ?? "Faça seu login" }} </h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
   
  </div>
  <div class="offcanvas-body">
    <NavbarHeader @openModalLoginFromNavbar="this.$emit('openModalLoginFromNavbar')" class="flex-lg-grow-1" />
    <FormSearch class="d-lg-block d-none" style="min-width: 250px;" />
    <NavIconsHeader class="ms-lg-2" @openModalLoginFromNavIcons="this.$emit('openModalLoginFromNavIcons')"
      @openModalRegisterFromNavIcons="this.$emit('openModalRegisterFromNavIcons')" />
  </div>
</template>

<script>
import NavbarHeader from './navigationheader.vue';
import NavIconsHeader from './NavIconsHeader.vue'
import FormSearch from './FormHeader.vue';
import { useAuthStore } from '../../stores/auth';

export default {
  emits: ['openModalLoginFromNavIcons', 'openModalLoginFromNavbar', 'openModalRegisterFromNavIcons'],
  data() {
    return {
      authStore: useAuthStore(),
    }
  },
  components: {
    NavbarHeader, NavIconsHeader, FormSearch
  },
}
</script>

<style lang="scss" scoped></style>