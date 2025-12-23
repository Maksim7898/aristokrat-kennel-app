<template>
    <section class="section-shell">
        <div class="mx-auto max-w-xl rounded-3xl bg-white p-8 shadow-soft">
            <SectionTitle
                eyebrow="Личный кабинет"
                title="Вход для клиентов"
            />
            <form class="mt-8 space-y-5" @submit.prevent="handleSubmit">
                <p v-if="formError" class="rounded-2xl bg-rose-50 px-4 py-3 text-xs text-rose-600">
                    {{ formError }}
                </p>
                <BaseInput v-model="form.email" label="Почта" placeholder="name@example.com" :error="errors.email"/>
                <BaseInput
                    v-model="form.password"
                    label="Пароль"
                    type="password"
                    placeholder="Минимум 8 символов"
                    :error="errors.password"
                />
                <BaseButton type="submit" class="w-full">Войти</BaseButton>
            </form>
        </div>
    </section>
</template>

<script setup>
import {reactive, ref} from 'vue'
import {useRouter} from 'vue-router'
import BaseButton from '@/components/BaseButton.vue'
import BaseInput from '@/components/BaseInput.vue'
import SectionTitle from '@/components/SectionTitle.vue'
import {useAuthStore} from '@/stores/auth'

const form = reactive({
    email: '',
    password: ''
})

const errors = reactive({
    email: '',
    password: ''
})

const formError = ref('')
const authStore = useAuthStore()
const router = useRouter()

const resetErrors = () => {
    errors.email = ''
    errors.password = ''
    formError.value = ''
}

const handleSubmit = async () => {
    resetErrors()

    const result = await authStore.login({
        email: form.email,
        password: form.password
    })

    if (result.ok) {
        await router.push('/account')
        return
    }

    if (result.errors?.email) {
        errors.email = result.errors.email[0]
    }
    if (result.errors?.password) {
        errors.password = result.errors.password[0]
    }
    if (!errors.email && !errors.password) {
        formError.value = result.message
    }
}
</script>
