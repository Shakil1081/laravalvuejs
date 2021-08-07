import VueRouter from "vue-router";
import Boolables from "./components/bookables/BookAbles";
import BookList from "./components/bookables/BookAbleList";
import Bookable from "./components/bookable/Bookable";
import Review from "./components/review/review";
const routes = [
    {
        path: "/bookables",
        component: Boolables,
        name: "bookables"
    },
    {
        path: "/booklist",
        component: BookList,
        name: "booklist"
    },
    {
        path: "/bookable/:id",
        component: Bookable,
        name: "bookable"
    }
    ,
    {
        path: "/review",
        component: Review,
        name: "reviewadd"
    }
];
const router = new VueRouter({
    mode: "history",
    routes: routes
});

export default router;
