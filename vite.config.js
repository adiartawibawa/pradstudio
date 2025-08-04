import { defineConfig } from "vite";
import { resolve } from "path";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
  plugins: [tailwindcss()],
  build: {
    rollupOptions: {
      input: {
        main: resolve(__dirname, 'index.html'),
        landing: resolve(__dirname, 'pages/index.html'),
        blog: resolve(__dirname, 'pages/blog/index.html'),
        // Add more entries for each page
      },
    },
  },
});
