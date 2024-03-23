import { defineStore } from "pinia";

export const useModalStore = defineStore("modal", {
  state() {
    return {
      login: false,
      register: false,
      forgotPassword: false,
      nameModalActive: "",
    };
  },
  actions: {
    updateModalName(name) {
      this.nameModalActive = name;
    },
  },
  getters: {},
});
