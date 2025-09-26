import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";
import { svelte } from "@sveltejs/vite-plugin-svelte";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            ssr: "resources/js/ssr.js",
            refresh: true,
        }),
        tailwindcss(),
        svelte(),
    ],
    resolve: {
        alias: {
            $lib: "/resources/js/lib",
        },
    },
});
