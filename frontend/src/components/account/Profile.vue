<template>
  <template v-if="showInfo">
    <div class="border h-100 d-flex flex-column" style="max-height: 600px !important;">
      <div class="row p-2">
        <div class="col-3 text-secondary small p-1">
          Nome
        </div>
        <div class="col-5 border-bottom border-secondary p-1">
          {{ data.name }}
        </div>
      </div>

      <div class="row p-2">
        <div class="col-3 text-secondary small p-1">
          Email
        </div>
        <div class="col-5 border-bottom border-secondary p-1">
          {{ data.email }}

        </div>
      </div>

      <div class="row mt-auto pb-2">
        <div class="col-4">
          <a href="#" class="btn btn-sm btn-secondary w-100" @click.prevent.stop="editProfile">Editar Informações</a>
        </div>
        <div class="col-4">
          <a href="#" class="btn btn-sm btn-secondary  w-100" @click.prevent.stop="editPassword">Alterar Senha</a>
        </div>
      </div>
    </div>
  </template>
  <template v-if="showEdit">
    <EditProfile :data="data" @cancel="cancel" />
  </template>
  <template v-if="changePassword">
    <ChangePassword  @cancel="cancel" />
  </template>
</template>

<script>

import { defineAsyncComponent } from 'vue';
import { useAuthStore } from '../../stores/auth';
const EditProfile = defineAsyncComponent({
  //@ts-ignore
  loader: () => import('./EditProfile.vue'),
});
const ChangePassword = defineAsyncComponent({
  loader: () => import('./ChangePassword.vue'),
});
export default {
  data() {
    const authStore = useAuthStore();
    return {
      data: {
        name: authStore?.session?.user?.name,
        email: authStore?.session?.user?.email
      },
      showInfo: true,
      showEdit: false,
      changePassword: false,
    }
  },
  methods: {
    editProfile() {
      this.showInfo = false;
      this.showEdit = true;
    },
    cancel() {
      this.showInfo = true;
      this.showEdit = false;
      this.changePassword = false;
    },
    editPassword() {
      this.showInfo = false;
      this.showEdit = false;
      this.changePassword = true;
    }
  },
  components: {
    EditProfile, ChangePassword
  },
}
</script>

<style lang="scss" scoped></style>