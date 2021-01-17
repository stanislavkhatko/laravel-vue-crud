import store from "../store";

// If user is not admin, redirect to a login page
export default function admin({next, router}) {

    if (!store.getters.isAdmin) {
        return router.push('/login').catch(err => {});
    }

    return next();
}
