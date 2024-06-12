import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/sass/app.scss",
                "resources/js/app.js",

                "resources/css/dashboard/apexcharts.css",
                "resources/css/dashboard/core.css",
                "resources/css/dashboard/demo.css",
                "resources/css/dashboard/page-auth.css",
                "resources/css/dashboard/perfect-scrollbar.css",
                "resources/css/dashboard/theme-default.css",
                "resources/js/dashboard/apexcharts.js",
                "resources/js/dashboard/config.js",
                "resources/js/dashboard/dashboards-analytics.js",
                "resources/js/dashboard/helpers.js",
                "resources/js/dashboard/main.js",
                "resources/js/dashboard/menu.js",
                "resources/js/dashboard/perfect-scrollbar.js",

                "resources/css/front/bootstrap.min.css",
                "resources/css/front/elegant-icons.css",
                "resources/css/front/font-awesome.min.css",
                "resources/css/front/nice-select.css",
                "resources/css/front/owl.carousel.min.css",
                "resources/css/front/slicknav.min.css",
                "resources/css/front/style.css",
                "resources/js/front/jquery.nice-select.min.js",
                "resources/js/front/jquery.slicknav.min.js",
                "resources/js/front/main.js",
                "resources/js/front/mixitup.min.js",
                "resources/js/front/owl.carousel.min.js",
            ],
            refresh: true,
        }),
    ],
});
