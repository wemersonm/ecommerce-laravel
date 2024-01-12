<template>
  <div>
    <nav class="nav">
      <ul class="nav flex-lg-column">
        <span class="fw-bold d-none d-lg-block">Gerenciar minha conta</span>
        <li class="nav-item">
          <router-link class="nav-link" :to="{ name: 'account-profile' }" exact-active>Meu
            Perfil</router-link>
        </li>
        <li class="nav-item  ">
          <router-link class="nav-link" :to="{ name: 'account-address' }">Meus
            Endereços</router-link>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Meus Cartões</a>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" :to="{ name: 'account-orders' }">Meus Pedidos</router-link>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Meus Favoritos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Meus Cupons</a>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {

}
</script>
<style lang="scss" scoped>
.nav {
  .nav-link.router-link-exact-active {
    color: $red !important;
  }

  .nav-link {
    color: $gray !important;
  }
}
</style>