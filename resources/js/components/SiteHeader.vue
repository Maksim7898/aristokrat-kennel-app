<template>
    <header class="bg-midnight text-white">
        <div class="section-shell flex flex-col gap-4 py-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <RouterLink to="/" class="flex items-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gold/20">
                        <img src="/logo.svg" alt="Аристократ" class="h-8 w-8"/>
                    </div>
                    <div>
                        <p class="font-display text-2xl">Аристократ</p>
                        <p class="text-sm text-white/70">Питомник чемпионов</p>
                    </div>
                </RouterLink>
                <div class="flex items-center gap-4 text-sm">
                    <template v-if="isAuthenticated">
                        <RouterLink to="/account" class="transition hover:text-gold">Кабинет</RouterLink>
                        <span class="text-white/40">/</span>
                        <button type="button" class="transition hover:text-gold" @click="handleLogout">
                            Выйти
                        </button>
                    </template>
                    <template v-else>
                        <RouterLink to="/login" class="transition hover:text-gold">Вход</RouterLink>
                        <span class="text-white/40">/</span>
                        <RouterLink to="/register" class="transition hover:text-gold">Регистрация</RouterLink>
                    </template>
                </div>
            </div>
            <nav class="flex flex-wrap items-center gap-4 rounded-2xl bg-white/10 px-5 py-3 text-sm">
                <RouterLink
                    v-for="link in navLinks"
                    :key="link.to"
                    :to="link.to"
                    class="rounded-full px-4 py-2 transition hover:bg-white/15"
                    :class="{ 'bg-gold text-midnight': isActive(link.to) }"
                >
                    {{ link.label }}
                </RouterLink>
            </nav>
        </div>
    </header>
</template>

<script setup>
import {computed} from 'vue'
import {useRoute, useRouter} from 'vue-router'
import {useAuthStore} from '@/stores/auth'

const route = useRoute()
const router = useRouter()
const authStore = useAuthStore()
const isAuthenticated = computed(() => authStore.isAuthenticated)

const navLinks = [
    {label: 'Главная', to: '/'},
    {label: 'Наши котята', to: '/cats'},
    {label: 'О породе', to: '/about'},
    {label: 'Блог', to: '/blog'},
    {label: 'Контакты', to: '/contacts'},
    {label: 'Личный кабинет', to: '/account'}
]

const isActive = (path) => route.path === path

const handleLogout = async () => {
    await authStore.logout()
    await router.push('/login')
}
</script>
