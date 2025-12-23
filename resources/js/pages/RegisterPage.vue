<template>
    <section class="section-shell">
        <div class="mx-auto max-w-3xl rounded-3xl bg-white p-8 shadow-soft">
            <SectionTitle
                eyebrow="Регистрация"
                title="Создание аккаунта"
            />
            <form class="mt-8 grid gap-5 md:grid-cols-2" @submit.prevent="handleSubmit">
                <p v-if="formError" class="md:col-span-2 rounded-2xl bg-rose-50 px-4 py-3 text-xs text-rose-600">
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
                <BaseInput
                    v-model="form.password_confirmation"
                    label="Повторите пароль"
                    type="password"
                    placeholder="Подтвердите пароль"
                    :error="errors.password_confirmation"
                />
                <BaseInput
                    v-model="form.full_name"
                    label="Фамилия Имя Отчество"
                    placeholder="Иванова Анна Сергеевна"
                    :error="errors.full_name"
                />
                <BaseInput
                    v-model="form.phone"
                    label="Телефон"
                    placeholder="+7 (999) 123-45-67"
                    :error="errors.phone"
                />
                <BaseInput v-model="form.city" label="Город проживания" placeholder="Москва" :error="errors.city"/>
                <BaseInput
                    v-model="form.pet_experience"
                    label="Опыт с животными"
                    placeholder="Опыт участия в выставках, разведение"
                    :error="errors.pet_experience"
                />
                <div class="md:col-span-2">
                    <BaseTextarea
                        v-model="form.living_conditions"
                        label="Условия проживания"
                        placeholder="Описание условий содержания"
                        :error="errors.living_conditions"
                    />
                </div>
                <div class="md:col-span-2">
                    <BaseButton type="submit" class="w-full">Создать аккаунт</BaseButton>
                </div>
            </form>
        </div>
    </section>
</template>

<script setup>
import {reactive, ref} from 'vue'
import {useRouter} from 'vue-router'
import BaseButton from '@/components/BaseButton.vue'
import BaseInput from '@/components/BaseInput.vue'
import BaseTextarea from '@/components/BaseTextarea.vue'
import SectionTitle from '@/components/SectionTitle.vue'
import {useAuthStore} from '@/stores/auth'

const form = reactive({
    email: '',
    password: '',
    password_confirmation: '',
    full_name: '',
    phone: '',
    city: '',
    pet_experience: '',
    living_conditions: ''
})

const errors = reactive({
    email: '',
    password: '',
    password_confirmation: '',
    full_name: '',
    phone: '',
    city: '',
    pet_experience: '',
    living_conditions: ''
})

const formError = ref('')
const authStore = useAuthStore()
const router = useRouter()

const resetErrors = () => {
    errors.email = ''
    errors.password = ''
    errors.password_confirmation = ''
    errors.full_name = ''
    errors.phone = ''
    errors.city = ''
    errors.pet_experience = ''
    errors.living_conditions = ''
    formError.value = ''
}

const handleSubmit = async () => {
    resetErrors()
    const result = await authStore.register({...form})

    if (result.ok) {
        await router.push('/account')
        return
    }

    Object.keys(errors).forEach((key) => {
        if (result.errors?.[key]?.length) {
            errors[key] = result.errors[key][0]
        }
    })

    if (!Object.values(errors).some(Boolean)) {
        formError.value = result.message
    }
}
</script>
