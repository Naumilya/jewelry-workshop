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
    { path: "/catalog", component: () => import("../Pages/CatalogPage.vue") },
    {
        path: "/contacts",
        component: () => import("../Pages/ContactsPage.vue"),
    },
    {
        path: "/custom-jewelry",
        component: () => import("../Pages/CustomJewelryPage.vue"),
    },

    {
        path: "/cart",
        component: () => import("../Pages/CartPage.vue"),
    },
    {
        path: "/deferred",
        component: () => import("../Pages/DeferredPage.vue"),
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
