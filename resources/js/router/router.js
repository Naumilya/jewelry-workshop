import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("../Pages/HomePage.vue"),
    },
    {
        path: "/test",
        component: () => import("../Pages/CatalogPage.vue"),
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
