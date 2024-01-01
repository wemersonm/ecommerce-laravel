<template>
  <div class="m-1">
    <div class="dropdown" @mouseleave="hideMenu">
      <button class="btn btn-secondary btn-sm dropdown-toggle w-100 " type="button" @click="toggleMenu"
        @mouseover="showMenu">
        Todos os Departamentos
      </button>
      <DropdownDepartaments class="z-index-dropdown" v-if="isMenuOpen" />
    </div>
    <div class="body">

    </div>
    <nav class="mt-3">
      <ul class="nav flex-column">
        <li class="nav-item text-center mb-2" v-for="category in categories" :key="category.id">
          <a href="#"
            class=" text-dark p-0 link-offset-1-hover  link-underline-opacity-0 link-underline-opacity-100-hover link-underline-danger">{{
              category.name }}</a>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
import { defineAsyncComponent } from 'vue';
const DropdownDepartaments = defineAsyncComponent({
  //@ts-ignore
  loader: () => import('../departaments/ListDepartaments.vue')
});

export default {
  emits: ['statusMenu'],
  data() {
    return {
      categories: [
        { id: 1, name: 'Placa mãe' },
        { id: 2, name: 'Memoria RAM' },
        { id: 3, name: 'Placa de video' },
        { id: 4, name: 'Monitores' },
        { id: 5, name: 'Fontes' },
        { id: 6, name: 'Teclados' },
        { id: 7, name: 'Mouse' },
        { id: 8, name: 'Fones' },
        { id: 9, name: 'Cpu\'s' },
      ],
      isMenuOpen: false,
    };
  },
  methods: {
    showMenu() {
      this.isMenuOpen = true;

    },
    hideMenu() {
      this.isMenuOpen = false;
    },
    toggleMenu() {
      this.isMenuOpen = !this.isMenuOpen;
    },
  },
  watch: {
    isMenuOpen(newValue,) {
      this.$emit('statusMenu', newValue);
    }
  },
  components: {
    DropdownDepartaments,
  },
}
</script>

<style scoped>
.dropdown {
  width: 100%;
}

.z-index-dropdown {
  z-index: 99999;
}
</style>