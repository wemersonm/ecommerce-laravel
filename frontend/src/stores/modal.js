import { defineStore } from "pinia";

const useModalStore = defineStore("modal", {
  state() {
    return {
      login: false,
      register: false,
      forgotPassword: false,
    };
  },
  actions: {},
  getters: {},
});
