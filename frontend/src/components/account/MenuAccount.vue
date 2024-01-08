<template>
  <div>
    <nav class="nav">
      <ul class="nav flex-column border ">
        <span class="fw-bold">Gerenciar minha conta</span>
        <li class="nav-item">
          <router-link class="nav-link text-body-secondary active " :to="{ name: 'account-profile' }">Meu
            Perfil</router-link>
        </li>
        <li class="nav-item  ">
          <router-link class="nav-link text-body-secondary " :to="{ name: 'account-address' }" @click.prevent>Meus
            Endereços</router-link>
        </li>
        <li class="nav-item">
          <a class="nav-link text-body-secondary" href="#">Meus Cartões</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-body-secondary" href="#">Meus Pedidos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-body-secondary" href="#">Meus Favoritos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-body-secondary" href="#">Meus Cupons</a>
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
.nav-item {
  &:active {
    color: $red !important;
  }

  .active {
    color: $red !important;
  }
}
</style>