import { createRouter, createWebHistory } from "vue-router";
import routes from "./routes.js";
import AuthService from "../services/AuthService.js";
import { useAuthStore } from "../stores/auth.js";

const router = createRouter({
  history: createWebHistory(),
  routes: routes,
});

router.beforeEach(async (to, from, next) => {
  let _next = null;
  let authIsValid = false;
  console.log('executado');
  try {
    authIsValid = await AuthService.getDataUserAuth(useAuthStore());
  } catch (error) {
  } finally {
    if (to?.meta?.requiresAuth && !authIsValid) {
      _next = { name: "login" };
    }
    next(_next);
  }
});

export default router;
