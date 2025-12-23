import {createRouter, createWebHistory} from 'vue-router'

import HomePage from '@/pages/HomePage.vue'
import ContactsPage from '@/pages/ContactsPage.vue'
import LoginPage from '@/pages/LoginPage.vue'
import RegisterPage from '@/pages/RegisterPage.vue'
import CatsPage from '@/pages/CatsPage.vue'
import CatDetailsPage from '@/pages/CatDetailsPage.vue'
import BlogPage from '@/pages/BlogPage.vue'
import BlogPostPage from '@/pages/BlogPostPage.vue'
import AboutPage from '@/pages/AboutPage.vue'
import AccountPage from '@/pages/AccountPage.vue'
import {useAuthStore} from '@/stores/auth'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {path: '/', component: HomePage},
        {path: '/contacts', component: ContactsPage},
        {path: '/login', component: LoginPage},
        {path: '/register', component: RegisterPage},
        {path: '/account', component: AccountPage, meta: {requiresAuth: true}},
        {path: '/cats', component: CatsPage},
        {path: '/cats/:slug', component: CatDetailsPage, props: true},
        {path: '/blog', component: BlogPage},
        {path: '/blog/:slug', component: BlogPostPage, props: true},
        {path: '/about', component: AboutPage}
    ],
    scrollBehavior() {
        return {top: 0}
    }
})

router.beforeEach(async (to) => {
    const authStore = useAuthStore()
    if (!authStore.ready) {
        await authStore.init()
    }
    if (to.meta.requiresAuth && !authStore.isAuthenticated) {
        return '/login'
    }
    if ((to.path === '/login' || to.path === '/register') && authStore.isAuthenticated) {
        return '/account'
    }
    return true
})

export default router
