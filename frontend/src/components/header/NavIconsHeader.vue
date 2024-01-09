<template>
  <ul class="navbar-nav align-items-lg-center d-lg-flex gap-lg-2 ">
    <li class="nav-item">
      <a class="nav-link d-flex align-items-center gap-2" href="#">
        <i class="bi bi-heart fs-4 text-danger"></i>
        <span class="d-lg-none d-inline-block">Favoritos</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link d-flex align-items-center gap-2" href="#">
        <i class="bi bi-cart3 fs-4"></i>
        <span class="d-lg-none d-inline-block">Carrinho</span>
      </a>
    </li>
    <li class="nav-item">
      <button v-if="authStore.isAuth" class="nav-link d-flex align-items-center text-nowrap gap-1 d-none d-lg-block">
        <i class="bi bi-person fs-4 open" data-bs-toggle="dropdown"></i>
        Olá, <span class="small text-nowrap open dropdown-toggle ms-1 fw-bold" id="triggerId" data-bs-toggle="dropdown"
          aria-expanded="false"> {{ authStore.getNameUser }}

          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="triggerId">
            <button class="dropdown-item" @click.stop="$router.push({ path: '/minha-conta' })">Perfil</button>

            <a class="dropdown-item" href="/pedidos">Pedidos</a>
            <button class="dropdown-item" @click.prevent.stop.self="logout"> Sair </button>

          </div>
        </span>
      </button>
      <button v-else href="#" class="nav-link d-flex align-items-center text-nowrap gap-1 d-none d-lg-block"
        @click="openModalLogin">
        <i class="bi bi-person fs-4 "></i>
      </button>
    </li>
    <li class="nav-item d-lg-none" v-if="authStore.isAuth">
      <button class="nav-link d-flex align-items-center gap-2">
        <i class="bi bi-box-arrow-left fs-4"></i>
        <span class="text-danger fw-bold" @click.stop.prevent.self="logout">Sair</span>
      </button>
    </li>
    <li class="nav-item d-lg-none" v-if="!authStore.isAuth">
      <ul class="nav flex-column d-lg-none mt-2 border rounded-3 w-100">
        <li class="nav-item">
          <button class=" w-100 btn btn-sm btn-danger mb-2 " aria-current="page" href="#"
            @click.prevent.self="this.$emit('openModalLoginFromNavIcons')">REALIZAR LOGIN</button>
        </li>
        <li class="nav-item">
          <button class=" w-100 btn btn-sm btn-secondary" aria-current="page" href="#"
            @click.prevent.self="this.$emit('openModalRegisterFromNavIcons')">CADASTRE-SE</button>
        </li>
      </ul>
    </li>
  </ul>
</template>

<script>
import { useAuthStore } from '../../stores/auth';
import AuthService from '../../services/AuthService';
export default {
  emits: ['openModalLoginFromNavIcons', 'openModalRegisterFromNavIcons'],
  data() {
    const { makeLogout } = AuthService;
    return {
      authStore: useAuthStore(),
      makeLogout,
    }
  },
  methods: {
    openModalLogin() {
      this.$emit('openModalLoginFromNavIcons');
    },
    logout() {
      this.makeLogout();
    }
  },

}
</script>

<style lang="scss" scoped></style>