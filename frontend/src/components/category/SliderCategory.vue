<template>
  <Slider :slides="categories" :breakpoints="swiperBreakpoints" :space-between="10" >
    <template v-slot:slide="{ slide }">
      <CardCategory :category="slide" :key="slide.name" class="d-flex justify-content-center"></CardCategory>
    </template>
  </Slider>
</template>

<script>
import Slider from '../utils/Slider.vue';
// @ts-ignore
import CardCategory from './CardCategory.vue';
export default {
  data() {
    return {
      slides: [],
      qtyPerSlide: null,
      categories: [
        { path: '../../../public/assets/images/category-icons/Category-VGA.svg', name: 'Placa de VideoVideoVideoVideoVideoVideo' },
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
      swiperBreakpoints: {
        1: {
          slidesPerView: 1,
        },
        391: {
          slidesPerView: 2,
        },
        576: {
          slidesPerView: 3,
        },
        768: {
          slidesPerView: 4,
        },
        992: {
          slidesPerView: 5,
        },
        1200: {
          slidesPerView: 6,
        },
        1201: {
          slidesPerView: 7,
        },
      },

    }
  },
  methods: {
  
  },

  components: {
    CardCategory,
    Slider
  },
}
</script>

<style lang="scss" scoped></style> 