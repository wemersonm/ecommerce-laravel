<template>
  <!--   <div :id="'carousel' + target" class=" carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item" v-for="( slide, index ) in   slides  " :key="index" :class="{ 'active': index === 0 }">
        <div class="d-flex gap-4 justity-content-center"
          :class="{ 'justify-content-center': qtyPerSlide == 1 || qtyPerSlide == 2 || qtyPerSlide == 3 }">
          <CardCategory v-for=" category  in  slide " :category="category" :key="category"></CardCategory>
        </div>
      </div>
    </div>
  </div> -->


  <Slider :slides="categories"  :breakpoints="swiperBreakpoints">
    <template v-slot:slide="{ slide }">
      <CardCategory :category="slide" :key="slide.name"></CardCategory>
    </template>
  </Slider>
</template>

<script>
import Slider from '../utils/Slider.vue';
// @ts-ignore
import CardCategory from './CardCategory.vue';
export default {
  props: {
    target: {
      type: String,
      default: "Example",
      required: true,
    },
  },
  data() {
    return {
      slides: [],
      qtyPerSlide: 6,
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
        391: {
          slidesPerView: 1,
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
          slidesPerView: 6,
        },
      },

    }
  },
  methods: {
    createSlides() {
      this.slides = [];
      for (let i = 0; i < this.categories.length; i += this.qtyPerSlide) {
        this.slides.push(this.categories.slice(i, i + this.qtyPerSlide));
      }
    },
    adjustQtyCardsPerScreen() {

      if (window.innerWidth < 391) {
        return 1;
      } else if (window.innerWidth < 632) {
        return 2;
      } else if (window.innerWidth < 768) {
        return 3;
      } else if (window.innerWidth < 992) {
        return 4;
      } else if (window.innerWidth < 1200) {
        return 5;
      } else {
        return 6;
      }
    },
    handlerResize() {
      this.qtyPerSlide = this.adjustQtyCardsPerScreen();
      this.createSlides();
    }
  },

  mounted() {
    window.addEventListener('resize', this.handlerResize);
    this.qtyPerSlide = this.adjustQtyCardsPerScreen();
    this.createSlides();
  },
  destroyed() {
    window.removeEventListener('resize', this.handlerResize);
  },
  components: {
    CardCategory,
    Slider
  },
}
</script>

<style lang="scss" scoped></style> 