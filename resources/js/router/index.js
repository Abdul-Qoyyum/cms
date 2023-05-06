import { createWebHistory, createRouter } from 'vue-router';
import store from '@/store';
import routePrefixer from "./route_prefixer";
import {isEmpty} from "lodash";
import axios from "axios";

/* Other component*/
const NotFoundComponent = () => import('@/components/NotFoundComponent.vue');

/* Guest Component */
const Auth = () => import('@/components/auth/Default.vue');
const Login = () => import('@/components/auth/Login.vue');
const Register = () => import('@/components/Register.vue');
/* Guest Component */

/* Authenticated Component(s) */
// const DahboardLayout = () => import('@/components/layouts/Default.vue');
// const Dashboard = () => import('@/components/layouts/Dashboard.vue');
// const Article = () => import('@/components/layouts/Article.vue');
// const ArticleUpdate = () => import('@/components/layouts/ArticleUpdate.vue');
// const ArticleList = () => import('@/components/layouts/ArticleList.vue');
// const Category = () => import('@/components/layouts/Category.vue');
// const CategoryList = () => import('@/components/layouts/CategoryList.vue');
// const CategoryUpdate = () => import('@/components/layouts/CategoryUpdate.vue');

let routes = [
    {
        name: "auth",
        path: `/auth`,
        component: Auth,
        meta: {
            middleware: "guest",
        },
        children: [
            {
                name: "login",
                path: 'login',
                component: Login,
                meta: {
                    title: `Login`
                }
            }
        ]
    },
    // {
    //     name: "register",
    //     path: `/register`,
    //     component: Register,
    //     meta: {
    //         middleware: "guest",
    //         title: `Register`
    //     }
    // },
    // {
    //     path: `/`,
    //     component: DahboardLayout,
    //     meta: {
    //         middleware: "auth"
    //     },
    //     children: [
    //         {
    //             name: "dashboard",
    //             path: 'dashboard',
    //             component: Dashboard,
    //             meta: {
    //                 title: `Dashboard`
    //             }
    //         },
    //         {
    //             name: "articles",
    //             path: 'create-article',
    //             component: Article,
    //             meta: {
    //                 title: `Article`
    //             }
    //         },
    //         {
    //             name: "articlesList",
    //             path: 'articles',
    //             component: ArticleList,
    //             meta: {
    //                 title: `ArticleList`
    //             }
    //         },
    //         {
    //             name: "articleUpdate",
    //             path: "article/:id/update",
    //             component: ArticleUpdate,
    //             meta: {
    //                 title: 'Article Update'
    //             }
    //         },
    //         {
    //             name: "category",
    //             path: 'category',
    //             component: Category,
    //             meta: {
    //                 title: `Category`
    //             }
    //         },
    //         {
    //             name: "categories",
    //             path: 'categories',
    //             component: CategoryList,
    //             meta: {
    //                 title: `Category`
    //             }
    //         },
    //         {
    //             name: "categoryUpdate",
    //             path: 'category/:id/update',
    //             component: CategoryUpdate,
    //             meta: {
    //                 title: `Update Category`
    //             }
    //         },
    //
    //     ]
    // },
    {
        name: "not-found",
        path: `/:pathMatch(.*)*`,
        component: NotFoundComponent,
        meta: {
            title: `Not found`
        }
    },
];

routes = routePrefixer("admin", routes);

const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title;
    const access_token = store?.state?.auth?._token?.access_token;
    if (to?.meta?.middleware === "guest") {
        if (store.state.auth.authenticated) {
            next({ name: "dashboard" })
        }
        next()
    } else {
        if (store.state.auth.authenticated) {
            next()
        } else {
            next({ name: "login" })
        }
    }
    //need to finalise on this
    // if(!isEmpty(access_token)){
    //     axios.post('/api/auth/refresh').then(({data}) => {
    //         store.dispatch('auth/refreshToken', data);
    //     });
    // }
})

export default router;
