import Vue from 'vue'
import Router from 'vue-router'

// Middleware
import admin from './middlewares/admin';
import guest from './middlewares/guest';

import Dashboard from "./dashboard/Dashboard";
import Login from "./dashboard/Login";
import Users from "./dashboard/Users";
import Reports from "./dashboard/Reports";

Vue.use(Router);

const router = new Router({
    mode: 'history',
    base: '/admin',
    scrollBehavior() {
        return {x: 0, y: 0}
    },
    routes: [
        {
            path: '/', component: Dashboard, meta: {middleware: [admin], },
            children: [
                {path: '', component: Users, meta: {middleware: [admin]}, redirect: '/users'},
                {path: 'users/:page?', component: Users, meta: {middleware: [admin]}},
                {path: 'reports/:page?', component: Reports, meta: {middleware: [admin]}}
            //     {path: '', redirect() {return 'email'}},
            //
            //     // {path: 'lost-password', component: LostPassword},
            //     {
            //         path: '*', redirect() {
            //             return '/'
            //             // component: Login
            //         }
            //     },
            ]
        },
        {path: '/login', component: Login, meta: {middleware: [guest]}},

        // {path: "*", component: Login}
    ]
});

function nextFactory(context, middleware, index) {
    const subsequentMiddleware = middleware[index];
    if (!subsequentMiddleware) return context.next;

    return (...parameters) => {
        // Run the default Vue Router `next()` callback first.
        context.next(...parameters);
        // Then run the subsequent Middleware with a new
        // `nextMiddleware()` callback.
        const nextMiddleware = nextFactory(context, middleware, index + 1);
        subsequentMiddleware({...context, next: nextMiddleware});
    };
}

router.beforeEach((to, from, next) => {
    if (to.meta.middleware) {
        const middleware = Array.isArray(to.meta.middleware)
            ? to.meta.middleware
            : [to.meta.middleware];

        const context = {from, next, router, to,};
        const nextMiddleware = nextFactory(context, middleware, 1);
        return middleware[0]({...context, next: nextMiddleware});
    }

    return next();
});

export default router
