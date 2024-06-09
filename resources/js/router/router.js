import { createRouter, createWebHistory } from "vue-router";
import AuthLayout from "../layouts/AuthLayout.vue";
import DefaultLayout from "../layouts/DefaultLayout.vue";

const routes = [
    {
        path: "/",
        component: () => import("../Pages/HomePage.vue"),
        meta: {
            layout: DefaultLayout,
        },
    },
    {
        path: "/news",
        component: () => import("../Pages/NewsPage.vue"),
        meta: {
            layout: DefaultLayout,
        },
    },
    {
        path: "/news/:id",
        component: () => import("../Pages/News.vue"),
        meta: {
            layout: DefaultLayout,
        },
    },
    {
        path: "/catalog",
        component: () => import("../Pages/CatalogPage.vue"),
        meta: {
            layout: DefaultLayout,
        },
    },
    {
        path: "/contacts",
        component: () => import("../Pages/ContactsPage.vue"),
        meta: {
            layout: DefaultLayout,
        },
    },
    {
        path: "/custom-jewelry",
        component: () => import("../Pages/CustomJewelryPage.vue"),
        meta: {
            layout: DefaultLayout,
        },
    },

    {
        path: "/cart",
        component: () => import("../Pages/CartPage.vue"),
        meta: {
            layout: DefaultLayout,
        },
    },
    {
        path: "/deferred",
        component: () => import("../Pages/DeferredPage.vue"),
        meta: {
            layout: DefaultLayout,
        },
    },

    {
        path: "/registration",
        component: () => import("../Pages/Auth/RegistrationPage.vue"),
        meta: {
            layout: AuthLayout,
        },
    },
    {
        path: "/login",
        component: () => import("../Pages/Auth/LoginPage.vue"),
        meta: {
            layout: AuthLayout,
        },
    },

    {
        path: "/restore",
        component: () => import("../Pages/Auth/RestorePage.vue"),
        meta: {
            layout: AuthLayout,
        },
    },
    {
        path: "/profile",
        component: () => import("../Pages/ProfilePage.vue"),
        meta: {
            layout: DefaultLayout,
        },
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
