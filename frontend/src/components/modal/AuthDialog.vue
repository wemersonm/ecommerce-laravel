<template>
  <button class="btn-sm btn btn-danger mt-3 d-none" data-bs-toggle="modal" :data-bs-target="'#' + idModal"
    ref="modalRef">Abrir modal</button>

  <div class="modal fade modal-lg" :style="style" :id="idModal" tabindex="1" :aria-labelledby="`${idModal}Label`"
    aria-hidden="true" data-bs-backdrop="static" @keydown.esc.stop="onEsc">

    <div class="modal-dialog" :style="style">
      <div class="modal-content border border-danger p-sm-3">
        <template v-if="brandTop">
          <div class="text-center">
            <p class="h1 font-family-logo">MyStore</p>
          </div>
        </template>
        <div class="modal-header">
          <button type="button" class="btn-close d-none" data-bs-dismiss="modal" aria-label="Close"
            ref="closeModalRef"></button>
          <p class="h5 modal-title text-danger text-underline">
            <span>
              <slot name="modal-header-title"></slot>
            </span>
          <div class="bg-danger" :style="underlineTitle"></div>
          </p>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
            @click.prevent.stop="onCloseModal"></button>
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
import { useModalStore } from '../../stores/modal';
export default {
  data() {
    const modalStore = useModalStore();
    return {
      modalStore,
      underlineTitle: 'width: 100%; height: 2px;',
    };
  },
  props: {
    idModal: {
      type: String,
      default: 'exampleModal'
    },
    style: {
      type: String,
      default: "",
    },
    brandTop: {
      type: Boolean,
      default: true,
    }
  },

  methods: {
    onCloseModal() {
      this.modalStore.updateModalName("");
    },
    onEsc() {
      this.modalStore.updateModalName("");
    },
  },
  mounted() {
    const modalRef = this.$refs.modalRef;
    modalRef.click();
  },
  beforeUnmount() {
    const closeModalRef = this.$refs.closeModalRef;
    closeModalRef.click();
  },

}
</script>

<style lang="scss" scoped></style>