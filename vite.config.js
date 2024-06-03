import vue from "@vitejs/plugin-vue";
import laravel from "laravel-vite-plugin";
// import { fileURLToPath, URL } from "node:url";
import { defineConfig } from "vite";
export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                "resources/css/app.scss",
                "resources/css/variables.scss",
                "resources/js/app.js",
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            vue: "vue/dist/vue.esm-bundler.js",
            // "@": fileURLToPath(new URL("./src", import.meta.url)),
        },
    },
});
