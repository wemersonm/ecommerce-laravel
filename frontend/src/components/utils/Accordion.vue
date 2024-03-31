<template>
  <div>
    <div class="accordion shadow-sm" :id="'accordion' + id">
      <slot name="accordion-item"></slot>
    </div>
  </div>
</template>

<script>
import AccordionItem from './AccordionItem.vue';

export default {
  props: {
    id: {
      type: String,
      required: true,
    },
  },

  data() {
    return {
    };
  },
  methods: {

  },

  components: {
    AccordionItem,
  },
}
</script>

<style lang="scss" scoped></style>