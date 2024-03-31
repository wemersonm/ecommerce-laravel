<template>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button :class="{ 'accordion-button collapsed fw-bold': true, }" type="button" data-bs-toggle="collapse"
        :data-bs-target="'#collapse' + index" aria-expanded="false" :aria-controls="'#collapse' + index">
        <slot name="header"></slot>
      </button>
    </h2>
    <div :id="'collapse' + index" class="accordion-collapse collapse" :data-bs-parent="'#accordion' + id">
      <div class="accordion-body">
        <slot name="body"></slot>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    id: {
      type: String,
      default: 'default'
    },
  },
  data() {
    return {
      index: '',
    };
  },
  methods: {
    generateIndex(lenght) {
      const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
      let result = '';
      for (let i = 0; i < lenght; i++) result += chars.charAt(Math.floor(Math.random() * chars.length));
      this.index = result;
    },
  },
  mounted() {
    this.generateIndex(12);
  },


}
</script>

<style lang="scss" scoped></style>