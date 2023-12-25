import { defineStore } from "pinia";

export const useAuthStore = defineStore("auth", {
  state() {
    return {
      isAuth: false,
      session: {},
    };
  },
  actions: {
    updateAuthState(data) {
      this.$patch(data);
    },
  },
  getters: {
    user() {
      return this?.session?.user;
    },
    getNameUser() {
      return this?.session?.user?.name;
    },
  },
});
