const routes = [
  {
    path: "/login",
    name: "login",
    alias: "/login",
    meta: { requiresAuth: false },
    component: () => import("../pages/login.vue"),
  },
  {
    path: "/",
    name: "home",
    alias: "/home",
    meta: { requiresAuth: false },
    component: () => import("../pages/home.vue"),
  },
  {
    path: "/minha-conta",
    name: "account",
    meta: { requiresAuth: false },
    component: () => import("../pages/account.vue"),
    children: [
      {
        path: "",
        name: "account-profile",
        meta: { requiresAuth: false },
        component: () => import("../components/account/Profile.vue"),
      },
      {
        path: "enderecos",
        name: "account-address",
        meta: { requiresAuth: false },
        component: () => import("../components/account/Address.vue"),
      },
      {
        path: "pedidos",
        name: "account-orders",
        meta: { requiresAuth: false },
        component: () => import("../components/account/Orders.vue"),
      },
    ],
  },

  {
    path: "/produto/:slug",
    name: "product",
    meta: { requiresAuth: false },
    component: () => import("../pages/product.vue"),
  },

  {
    path: "/favoritos",
    name: "favorites",
    meta: { requiresAuth: false },
    component: () => import("../pages/favorites.vue"),
  },

  {
    path: "/auth/reset-password",
    name: "resetPassword",
    meta: { requiresAuth: false },
    component: () => import("../pages/ResetPassword.vue"),
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
