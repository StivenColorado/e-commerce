import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import path from "path";
export default defineConfig({
  plugins: [
    laravel({
      input: ["resources/sass/app.scss", "resources/js/app.js"],
      refresh: true,
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
        compilerOptions: {
          isCustomElement: (tag) => ["category-modal"].includes(tag),
        },
      },
    }),
  ],
  build: {
    chunkSizeWarningLimit: 1600,
  },
  resolve: {
    alias: {
      vue: "vue/dist/vue.esm-bundler.js",
      "@": path.resolve(__dirname, "resource/js"),
      "~": path.resolve(__dirname, "node_modules"),
    },
  },
});
