<template>
    <section class="section-shell">
        <div class="mx-auto max-w-3xl rounded-3xl bg-white p-8 shadow-soft">
            <SectionTitle
                eyebrow="Личный кабинет"
                title="Ваш профиль"
                subtitle="Данные учетной записи и анкеты."
            />
            <div v-if="user" class="mt-8 grid gap-4 md:grid-cols-2">
                <div class="rounded-2xl bg-midnight/5 p-4">
                    <p class="text-xs uppercase tracking-wide text-midnight/60">ФИО</p>
                    <p class="mt-2 text-sm font-medium text-midnight">{{ user.full_name }}</p>
                </div>
                <div class="rounded-2xl bg-midnight/5 p-4">
                    <p class="text-xs uppercase tracking-wide text-midnight/60">Почта</p>
                    <p class="mt-2 text-sm font-medium text-midnight">{{ user.email }}</p>
                </div>
                <div class="rounded-2xl bg-midnight/5 p-4">
                    <p class="text-xs uppercase tracking-wide text-midnight/60">Телефон</p>
                    <p class="mt-2 text-sm font-medium text-midnight">{{ user.phone }}</p>
                </div>
                <div class="rounded-2xl bg-midnight/5 p-4">
                    <p class="text-xs uppercase tracking-wide text-midnight/60">Город</p>
                    <p class="mt-2 text-sm font-medium text-midnight">{{ user.city }}</p>
                </div>
                <div class="rounded-2xl bg-midnight/5 p-4 md:col-span-2">
                    <p class="text-xs uppercase tracking-wide text-midnight/60">Опыт с животными</p>
                    <p class="mt-2 text-sm font-medium text-midnight">{{ user.pet_experience }}</p>
                </div>
                <div class="rounded-2xl bg-midnight/5 p-4 md:col-span-2">
                    <p class="text-xs uppercase tracking-wide text-midnight/60">Условия проживания</p>
                    <p class="mt-2 text-sm font-medium text-midnight">{{ user.living_conditions }}</p>
                </div>
                <div class="rounded-2xl bg-midnight/5 p-4">
                    <p class="text-xs uppercase tracking-wide text-midnight/60">Роль</p>
                    <p class="mt-2 text-sm font-medium text-midnight">{{ user.role }}</p>
                </div>
                <div class="rounded-2xl bg-midnight/5 p-4">
                    <p class="text-xs uppercase tracking-wide text-midnight/60">Дата регистрации</p>
                    <p class="mt-2 text-sm font-medium text-midnight">{{ user.created_at }}</p>
                </div>
                <div class="md:col-span-2">
                    <BaseButton class="w-full" type="button" @click="handleLogout">
                        Выйти из аккаунта
                    </BaseButton>
                </div>
            </div>
            <div v-else class="mt-8 text-sm text-midnight/60">
                Загрузка данных профиля...
            </div>
        </div>
    </section>
</template>

<script setup>
import {computed, onMounted} from 'vue'
import {useRouter} from 'vue-router'
import BaseButton from '@/components/BaseButton.vue'
import SectionTitle from '@/components/SectionTitle.vue'
import {useAuthStore} from '@/stores/auth'

const authStore = useAuthStore()
const router = useRouter()

const user = computed(() => authStore.user)

onMounted(async () => {
    if (!authStore.user && authStore.isAuthenticated) {
        await authStore.fetchMe()
    }
})

const handleLogout = async () => {
    await authStore.logout()
    await router.push('/login')
}
</script>
