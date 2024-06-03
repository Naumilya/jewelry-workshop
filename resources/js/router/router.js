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
    { path: "/news/:id", component: () => import("../Pages/News.vue") },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
