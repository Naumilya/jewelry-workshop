import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("../Pages/HomePage.vue"),
    },
    {
        path: "/news",
        component: () => import("../Pages/NewsPage.vue"),
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
