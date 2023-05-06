import { createWebHistory, createRouter } from 'vue-router';
import store from '@/store';
import {isEmpty} from "lodash";
import axios from "axios";

/* Other component*/
const NotFoundComponent = () => import('@/components/NotFoundComponent.vue');

/* Guest Component */
const Auth = () => import('@/components/auth/Default.vue');
const Login = () => import('@/components/auth/Login.vue');
// const Register = () => import('@/components/Register.vue');
/* Guest Component */

/* Authenticated Component(s) */
const DahboardBaseLayout = () => import('@/components/layouts/Default.vue');
const Dashboard = () => import('@/components/layouts/Dashboard.vue');

let routes = [
    {
        name: "auth",
        path: `/`,
        component: Auth,
        meta: {
            middleware: "guest",
        },
        children: [
            {
                name: "login",
                path: '',
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
    {
        name: "dashboard",
        path: `/dashboard`,
        component: DahboardBaseLayout,
        meta: {
            middleware: "auth"
        },
        children: [
            {
                name: 'home',
                path: '',
                component: Dashboard,
                meta: {
                    title: `Dashboard`
                }
            },
        ]
    },
    {
        name: "not-found",
        path: `/:pathMatch(.*)*`,
        component: NotFoundComponent,
        meta: {
            title: `Not found`
        }
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title;
    // const access_token = store?.state?.auth?._token?.access_token;
    console.log(store.state.auth.authenticated);
    if (to?.meta?.middleware === "guest") {
        if (store.state.auth.authenticated) {
            next({ name: "home" })
        }else{
            next();
        }
    } else {
        if (store.state.auth.authenticated) {
            next()
        } else {
            next({ name: "login" })
        }
    }
})

export default router;
