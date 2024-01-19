<template>
  <div>
    <div class="accordion shadow" :id="'accordion' + id">
      <div class="accordion-item" v-for="(item, index) in items" :key="index">
        <h2 class="accordion-header">
          <button :class="{ 'accordion-button collapsed fw-bold': true, 'show': item?.expanded }" type="button"
            data-bs-toggle="collapse" :data-bs-target="'#collapse' + index" :aria-expanded="item?.expanded ?? false"
            :aria-controls="'#collapse' + index">
            {{ item.header }}
          </button>
        </h2>
        <div :id="'collapse' + index" class="accordion-collapse collapse" :data-bs-parent="'#accordion' + id">
          <div class="accordion-body">
            <template v-if="vHtml">
              <div v-html="item.body"></div>
            </template>
            <template v-else>
              <div> {{ item.body }}</div>
            </template>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    items: {
      type: Array,
      default: [],
      required: true,
    },
    vHtml: {
      type: Boolean,
      default: false,
    }
  },


  data() {
    return {
      id: Math.floor(Math.random() * 1000),
    }
  },

}
</script>

<style lang="scss" scoped></style>