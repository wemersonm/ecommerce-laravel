const routes = [
  {
    path: "/",
    name: "home",
    alias: "/home",
    meta: { requiresAuth: false },
    component: () => import("../pages/home.vue"),
  },
  {
    path: "/login",
    name: "login",
    alias: "/login",
    meta: { requiresAuth: false },
    component: () => import("../pages/login.vue"),
  },


  {
    path: "/dashboard",
    name: "dashboard",
    alias: "/dashboard",
    meta: { requiresAuth: true },
    component: () => import("../pages/dashboard.vue"),
  },
];

export default routes;
