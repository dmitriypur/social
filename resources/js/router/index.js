import {createRouter, createWebHistory} from 'vue-router'

const router = new createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),

    routes: [
        {path: '/users', name: 'user.index', component: () => import('../views/user/Index.vue')},
        {path: '/users/:id/show', name: 'user.show', component: () => import('../views/user/Show.vue')},
        {path: '/users/feed', name: 'user.feed', component: () => import('../views/user/Feed.vue')},

        {path: '/login', name: 'user.login', component: () => import('../views/user/Login.vue')},
        {path: '/register', name: 'user.register', component: () => import('../views/user/Registration.vue')},
        {path: '/personal', name: 'user.personal', component: () => import('../views/user/Personal.vue')},
    ]
})

router.beforeEach((to, from, next) => {
    axios.get('/api/user')
        .catch(e => {
            if (e.response.status === 401) {
                localStorage.key('auth') ? localStorage.removeItem('auth') : ''
            }
        })
    const token = localStorage.getItem('auth')

    if (!token) {
        if (to.name === 'user.login' || to.name === 'user.register') {
            return next()
        } else {
            return next({
                name: 'user.login'
            })
        }
    }

    if (to.name === 'user.login' || to.name === 'user.register' && token) {
        return next({
            name: 'user.personal'
        })
    }

    next()
})

export default router
