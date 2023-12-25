<template>
  <div class="modal fade" :id="idModal" tabindex="1" :aria-labelledby="`${idModal}Label`" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content border border-danger">
        <div class="modal-header">
          <slot name="modal-header"></slot>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
            @click.prevent.stop="$emit('closeModal')"></button>
        </div>
        <div class="modal-body">
          <slot name="modal-body"></slot>
        </div>
        <div class="modal-footer">
          <slot name="modal-footer"></slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    idModal: {
      type: String,
      default: 'exampleModal'
    },
  },
  emits: ['closeModal'],

  methods: {

  },
}
</script>

<style lang="scss" scoped></style>