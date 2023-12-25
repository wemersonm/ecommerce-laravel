<template>
  <ul class="navbar-nav align-items-lg-center justify-content-center nav-underline">
    <li class="nav-item d-lg-none mb-3">
      <a class=" btn btn-warning btn-sm w-100 d-flex align-items-center" href="#">
        <i class="bi bi-menu-button-wide fs-5"></i>
        <span class="flex-grow-1">Todos os Departamentos</span>
      </a>
    </li>
    <li class="nav-item d-lg-none">
      <a href="#" class="nav-link d-flex align-items-center gap-2">
        <i class="bi bi-person-vcard fs-4"></i>
        <span>Perfil</span>
      </a>
    </li>
    <li class="nav-item d-lg-none">
      <a href="#" class="nav-link d-flex align-items-center gap-2">
        <i class="bi bi-bag-check fs-4"></i>
        <span>Meus Pedidos</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link d-flex align-items-center gap-2" href="#">
        <i class="d-block d-lg-none bi bi-house fs-4"></i>
        <span class=" d-inline-block">
          Página Inicial
        </span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link d-flex align-items-center gap-2" href="#">
        <i class="d-block d-lg-none bi bi-headset fs-4"></i>
        <span class=" d-inline-block">
          Contato
        </span>
      </a>

    </li>
    <li class="nav-item ">
      <a class="nav-link d-flex align-items-center gap-2" href="#">
        <i class="d-block d-lg-none bi bi-briefcase fs-4"></i>
        <span class=" d-inline-block">
          Sobre
        </span>
      </a>

    </li>
    <li class="nav-item d-none d-lg-block" v-if="!authStore.isAuth">
      <button class="nav-link btn btn-light" href="#" @click.prevent.stop="emitOpenModalLogin">Login</button>
    </li>

  </ul>
</template>

<script>
import { useAuthStore } from '../../stores/auth';
export default {
  emits: ['openModalLoginFromNavbar'],
  data() {
    return {
      authStore: useAuthStore(),
    }
  },
  methods: {
    emitOpenModalLogin() {
      this.$emit('openModalLoginFromNavbar');
    }
  },
}
</script>

<style lang="scss" scoped></style>