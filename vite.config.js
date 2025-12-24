import { defineConfig } from "vite";

// import { createHtmlPlugin } from "vite-plugin-html";
// import vueDevTools from "vite-plugin-vue-devtools";

import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";
import vue from "@vitejs/plugin-vue";
import path from "path"; // Import path

export default defineConfig({
    plugins: [
        // vueDevTools(),
        // createHtmlPlugin({}),
        vue(),
        tailwindcss(),

        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "ziggy-js": path.resolve(
                __dirname,
                "vendor/tightenco/ziggy/dist/vue.es.js"
            ),
        },
    },
});
