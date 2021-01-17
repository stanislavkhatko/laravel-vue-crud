import store from "../store";

export default function authenticated({next, router}) {

    if (store.getters.isAdmin) {
        return router.push('/').catch(err => {});
    }

    return next();
}
