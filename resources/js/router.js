import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Home from "./pages/Home";
import About from "./pages/About";
import Categories from "./pages/Categories";
import SingleCategory from "./pages/SingleCategory";
import SinglePost from "./pages/SinglePost";
import Page404 from "./pages/Page404";

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home,
        },
        {
            path: "/chi-siamo",
            name: "about",
            component: About,
        },
        {
            path: "/categorie",
            name: "categories",
            component: Categories,
        },
        {
            path: "/categoria/:slug",
            name: "single-category",
            component: SingleCategory,
        },
        {
            path: "/posts/:slug",
            name: "single-post",
            component: SinglePost,
        },
        {
            path: "/*",
            name: "page-404",
            component: Page404,
        }
    ]
});

export default router;