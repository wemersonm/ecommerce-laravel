<template>
  <div class="d-flex gap-4 overflow-x-scroll container-category-ref w-100 border justify-content-center p-1">
    <CardCategory v-for="category in categories" :category="category" :key="category"></CardCategory>
  </div>
</template>

<script>
import CardCategory from '../utils/CardCategory.vue';
export default {
  data() {
    return {
      categories: [
        { path: '../../../public/assets/images/category-icons/Category-VGA.svg', name: 'Placa de Video' },
        { path: '../../../public/assets/images/category-icons/Category-Motherboard.svg', name: 'Placa Mãe' },
        { path: '../../../public/assets/images/category-icons/Category-Cpu.svg', name: 'Processadores' },
        { path: '../../../public/assets/images/category-icons/Category-Ram.svg', name: 'Memoria RAM' },
        { path: '../../../public/assets/images/category-icons/Category-Computer.svg', name: 'Monitores' },
        { path: '../../../public/assets/images/category-icons/Category-Power.svg', name: 'Fonte de Alimentação' },
        { path: '../../../public/assets/images/category-icons/Category-Mouse.svg', name: 'Mouse' },
        { path: '../../../public/assets/images/category-icons/Category-Keyboard.svg', name: 'Teclados' },
        { path: '../../../public/assets/images/category-icons/Category-Cooler.svg', name: 'Coolers' },
        { path: '../../../public/assets/images/category-icons/Category-Headphone.svg', name: 'Fones' },
        { path: '../../../public/assets/images/category-icons/Category-CellPhone.svg', name: 'Celulares' },
        { path: '../../../public/assets/images/category-icons/Category-Laptop.svg', name: 'Notebooks' },
        { path: '../../../public/assets/images/category-icons/Category-Camera.svg', name: 'Câmeras' },
        { path: '../../../public/assets/images/category-icons/Category-SmartWatch.svg', name: 'Smarthwatch' },
      ],

    }
  },
  components: {
    CardCategory,
  },
}
</script>

<style lang="scss" scoped>
.container-category-ref {

  scrollbar-width: none;

  &::-webkit-scrollbar {
    display: none;
  }

}
</style>