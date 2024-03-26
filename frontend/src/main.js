import { createApp } from "vue";
import "./style.css";

import App from "./App.vue";
import { createPinia } from "pinia";
import router from "./routes/index";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap/dist/js/bootstrap.js";
import "bootstrap-icons/font/bootstrap-icons.css";

const pinia = createPinia();
const app = createApp(App);
app.use(pinia);
app.use(router);
// app.config.globalProperties.activeHorizontalCardWhen = 478;
app.mount("#app");


