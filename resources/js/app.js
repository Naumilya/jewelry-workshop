import { createPinia } from "pinia";
import { createApp } from "vue";
import App from "./App.vue";
import router from "./router/router";
import "/resources/css/app.scss";

const pinia = createPinia();
const app = createApp(App);

app.use(router).use(pinia).mount("#app");
