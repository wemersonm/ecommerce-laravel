<template>
  <div class="row">
    <div class="col-12">
      <NameSection :name="name" />
    </div>
    <div class="d-flex justify-content-between mt-4">
      <div class="fw-bold">
        <span class="responsive-font">{{ title }}</span>
      </div>
      <div class="px-1" v-if="showMiddle">
        <slot name="middle"></slot>
      </div>
      <div class="d-flex gap-2 justify-content-end" v-if="showNavigation">
        <i class="bi bi-arrow-left-circle fs-3" type="button" :data-bs-target="`#carousel${target}`"
          data-bs-slide="prev"></i>
        <i class="bi bi-arrow-right-circle fs-3" type="button" :data-bs-target="`#carousel${target}`"
          data-bs-slide="next"></i>
      </div>
    </div>
  </div>
</template>

<script>
import NameSection from './NameSection.vue';
export default {
  props: {
    name: {
      type: String,
      default: "Seção",
      required: true,
    },
    title: {
      type: String,
      default: "Titulo",
      required: true,
    },
    target: {
      type: String,
      default: "Example",
    },
    showNavigation: {
      type: Boolean,
      default: true,
    },
    showMiddle: {
      type: Boolean,
      default: true,
    }
  },
  data() {
    return {

    }
  },
  methods: {
  },
  components: { NameSection }
}
</script>

<style lang="scss" scoped>
.responsive-font {
  font-size: calc(12px + 0.7vw);
}

.bi-arrow-left-circle,
.bi-arrow-right-circle {
  &:hover {
    transform: scale(1.1);
    color: $red;
  }
}
</style>