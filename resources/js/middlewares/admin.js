import store from "../store";
export default function admin({next, router}) {

    if (!store.getters.isAdmin) {
        return router.push('/login').catch(err => {});
    }

    return next();
}
