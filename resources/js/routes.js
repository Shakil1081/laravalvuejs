import VueRouter from 'vue-router';
import ExampleComponent from "./components/ExampleComponent";
import Example2 from "./components/Example2";
import Boolable from "./components/bookables/BookAble";
import BookList from "./components/bookables/BookAbleList";
const routes = [
    {
        path: "/",
        component: ExampleComponent,
        name: 'home',
    },
    {
        path: "/2",
        component: Example2,
        name: 'second',
    }, 
    {
        path: "/booknow",
        component: Boolable,
        name: 'boolable',
    },
    {
        path: "/booklist",
        component: BookList,
        name: 'booklist',
    }
];
const router = new VueRouter({
    mode: 'history',
    routes:routes,
    
})

export default router;

