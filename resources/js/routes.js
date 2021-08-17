import VueRouter from 'vue-router'
import Boolables from './components/bookables/BookAbles'
import BookList from './components/bookables/BookAbleList'
import Bookable from './components/bookable/Bookable'
import Review from './components/review/Review'
const routes = [
<<<<<<< HEAD
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
        path: "/review/:id",
        component: Review,
        name: "reviewadd"
    }
];
=======
  {
    path: '/bookables',
    component: Boolables,
    name: 'bookables'
  },
  {
    path: '/booklist',
    component: BookList,
    name: 'booklist'
  },
  {
    path: '/bookable/:id',
    component: Bookable,
    name: 'bookable'
  },
  {
    path: '/review/:id',
    component: Review,
    name: 'reviewadd'
  }
]
>>>>>>> d575f1c8bc915e6e7a93bef889b7822df995fc47
const router = new VueRouter({
  mode: 'history',
  routes: routes
})

export default router
