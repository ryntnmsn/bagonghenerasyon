import "./bootstrap";
import { createApp, h } from "vue";
import { createInertiaApp, Head, Link } from "@inertiajs/vue3";
import AdminLayout from "./Layouts/AdminLayout.vue";
import FrontendLayout from "./Layouts/FrontendLayout.vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";

createInertiaApp({
    title: (title) =>
        title
            ? `${title} | Bagong Henerasyon Partylist`
            : "Bagong Henerasyon Partylist",
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });

        const page = pages[`./Pages/${name}.vue`];

        // Auto layout selection
        if (name.startsWith("Admin/")) {
            page.default.layout = page.default.layout || AdminLayout;
        } else {
            page.default.layout = page.default.layout || FrontendLayout;
        }

        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component("Head", Head)
            .component("Link", Link)
            .mount(el);
    },
    progress: {
        delay: 250,
        color: "#ff0707",
        showSpinner: true,
    },
});
