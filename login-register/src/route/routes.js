export const routes = {
    mode: 'history',
    routes: [
        {
            path: '/register',
            name: 'register',
            component: () => import('../components/Register'),
        },
        {
            path: '/login',
            name: 'login',
            component: () => import('../components/Login'),
        },
    ]
}
