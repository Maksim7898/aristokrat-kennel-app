<template>
    <section class="section-shell">
        <div v-if="cat" class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="rounded-3xl bg-white p-6 shadow-soft">
                <img :src="cat.image_url" :alt="cat.name" class="h-80 w-full rounded-2xl object-cover"/>
                <div class="mt-6 space-y-4">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <h1 class="font-display text-3xl">{{ cat.name }}</h1>
                        <span class="rounded-full bg-gold/20 px-4 py-2 text-sm">{{ formatPrice(cat.price) }} ₽</span>
                    </div>
                    <p class="text-sm text-midnight/70">{{ cat.character }}</p>
                    <div class="grid gap-3 text-sm text-midnight/70 md:grid-cols-2">
                        <p><strong class="text-midnight">Пол:</strong> {{ cat.gender }}</p>
                        <p><strong class="text-midnight">Статус:</strong> {{ cat.status }}</p>
                        <p><strong class="text-midnight">Дата рождения:</strong> {{ cat.date_of_birth }}</p>
                        <p><strong class="text-midnight">Просмотры:</strong> {{ cat.views }}</p>
                        <p class="col-span-2"><strong class="text-midnight">Прививки:</strong> {{
                                cat.vaccination_info
                            }}</p>
                    </div>
                </div>
            </div>
            <div class="space-y-6">
                <div class="rounded-3xl bg-white p-6 shadow-soft" v-if="cat.class">
                    <h2 class="font-display text-2xl">Класс: {{ cat.class.name }}</h2>
                    <p class="mt-3 text-sm text-midnight/70">{{ cat.class.description }}</p>
                </div>
                <div class="rounded-3xl bg-white p-6 shadow-soft" v-if="cat.breed">
                    <h2 class="font-display text-2xl">Порода: {{ cat.breed.name }}</h2>
                    <p class="mt-3 text-sm text-midnight/70">{{ cat.breed.description }}</p>
                </div>
                <div class="rounded-3xl bg-white p-6 shadow-soft" v-if="cat.mother || cat.father">
                    <h2 class="font-display text-2xl">Родословная</h2>
                    <div class="mt-4 space-y-3 text-sm text-midnight/70">
                        <p v-if="cat.mother" class="flex items-center gap-2">
                            <strong class="text-midnight">Мать:</strong>
                            <RouterLink :to="`/cats/${cat.mother.slug}`" class="text-gold">{{
                                    cat.mother.name
                                }}
                            </RouterLink>
                        </p>
                        <p v-if="cat.father" class="flex items-center gap-2">
                            <strong class="text-midnight">Отец:</strong>
                            <RouterLink :to="`/cats/${cat.father.slug}`" class="text-gold">{{
                                    cat.father.name
                                }}
                            </RouterLink>
                        </p>
                    </div>
                </div>
                <div class="rounded-3xl bg-white p-6 shadow-soft" v-if="cat">
                    <h2 class="font-display text-2xl">Заявка на котёнка</h2>
                    <p class="mt-2 text-sm text-midnight/70">
                        Оставьте заявку, и менеджер свяжется с вами для уточнения деталей.
                    </p>
                    <div v-if="!isAuthenticated" class="mt-4 rounded-2xl bg-sand px-4 py-3 text-sm text-midnight/70">
                        Чтобы оставить заявку, пожалуйста,
                        <RouterLink to="/login" class="text-gold">войдите</RouterLink>
                        в аккаунт.
                    </div>
                    <div v-else-if="existingRequest" class="mt-4 space-y-4">
                        <div class="grid gap-3 text-sm text-midnight/70 md:grid-cols-2">
                            <p><strong class="text-midnight">Тип:</strong> {{ existingRequest.type }}</p>
                            <p><strong class="text-midnight">Статус:</strong> {{ existingRequest.status.label }}</p>
                            <p><strong class="text-midnight">Сумма:</strong> {{ formatPrice(existingRequest.amount) }} ₽</p>
                            <p><strong class="text-midnight">Дата:</strong> {{ existingRequest.created_at }}</p>
                        </div>
                        <div class="rounded-2xl bg-midnight/5 px-4 py-3 text-sm text-midnight/70">
                            <strong class="text-midnight">Цель приобретения:</strong>
                            <p class="mt-2 text-midnight/70">{{ existingRequest.purpose }}</p>
                        </div>
                        <p v-if="cancelError" class="rounded-2xl bg-rose-50 px-4 py-3 text-xs text-rose-600">
                            {{ cancelError }}
                        </p>
                        <BaseButton
                            v-if="canCancelRequest"
                            type="button"
                            class="w-full"
                            @click="cancelRequest"
                        >
                            Отменить заявку
                        </BaseButton>
                    </div>
                    <form v-else class="mt-4 space-y-4" @submit.prevent="submitRequest">
                        <p v-if="requestMessage" class="rounded-2xl bg-emerald-50 px-4 py-3 text-xs text-emerald-700">
                            {{ requestMessage }}
                        </p>
                        <p v-if="requestError" class="rounded-2xl bg-rose-50 px-4 py-3 text-xs text-rose-600">
                            {{ requestError }}
                        </p>
                        <BaseSelect
                            v-model="requestForm.type"
                            label="Тип заявки"
                            placeholder="Выберите тип заявки"
                            :options="requestTypeOptions"
                            :error="requestErrors.type"
                        />
                        <BaseTextarea
                            v-model="requestForm.purpose"
                            label="Цель приобретения"
                            placeholder="Например: домашний любимец, разведение, выставки"
                            :error="requestErrors.purpose"
                        />
                        <div class="rounded-2xl bg-midnight/5 px-4 py-3 text-xs text-midnight/60">
                            Сумма заявки: {{ formatPrice(cat.price) }} ₽
                        </div>
                        <BaseButton type="submit" class="w-full">Отправить заявку</BaseButton>
                    </form>
                </div>
            </div>
        </div>

        <div class="mt-12 rounded-3xl bg-white p-6 shadow-soft">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <SectionTitle
                    eyebrow="Отзывы"
                    title="Отзывы владельцев"
                    subtitle="Мы ценим честный опыт наших клиентов и постоянно совершенствуем сервис."
                />
                <BaseButton v-if="canLeaveReview" @click="isModalOpen = true">Добавить отзыв</BaseButton>
            </div>
            <div v-if="!canLeaveReview" class="mt-4 rounded-2xl bg-sand px-4 py-3 text-sm text-midnight/70">
                <template v-if="!isAuthenticated">
                    Чтобы оставить отзыв, пожалуйста,
                    <RouterLink to="/login" class="text-gold">войдите</RouterLink>
                    в аккаунт.
                </template>
                <template v-else-if="!existingRequest">
                    Оставить отзыв можно после отправки заявки на котёнка.
                </template>
                <template v-else>
                    Оставить отзыв можно после статуса «Готова». Текущий статус: {{ existingRequest.status.label }}.
                </template>
            </div>
            <p v-if="reviewMessage" class="mt-4 rounded-2xl bg-emerald-50 px-4 py-3 text-xs text-emerald-700">
                {{ reviewMessage }}
            </p>
            <div class="mt-6 grid gap-4 md:grid-cols-2">
                <div v-for="review in catReviews" :key="review.id" class="rounded-2xl bg-sand p-4">
                    <div class="flex items-center justify-between">
                        <p class="font-medium">{{ review.author }}</p>
                        <RatingStars :rating="review.rating" readonly/>
                    </div>
                    <p class="mt-3 text-sm text-midnight/70">{{ review.text }}</p>
                    <p class="mt-3 text-xs text-midnight/40">{{ review.date }}</p>
                </div>
            </div>
        </div>

        <BaseModal v-model="isModalOpen" title="Новый отзыв" subtitle="Поделитесь впечатлением о питомце.">
            <form class="space-y-4" @submit.prevent="submitReview">
                <p v-if="reviewError" class="rounded-2xl bg-rose-50 px-4 py-3 text-xs text-rose-600">
                    {{ reviewError }}
                </p>
                <div>
                    <p class="text-sm font-medium text-midnight/70">Рейтинг</p>
                    <RatingStars :rating="newReview.rating" @update:rating="(value) => (newReview.rating = value)"/>
                </div>
                <BaseTextarea
                    v-model="newReview.text"
                    label="Текст отзыва"
                    placeholder="Расскажите о впечатлениях"
                    :error="formError"
                />
                <BaseButton type="submit" class="w-full">Отправить</BaseButton>
            </form>
        </BaseModal>
    </section>
</template>

<script setup>
import {computed, onMounted, reactive, ref, watch} from 'vue'
import {useRoute} from 'vue-router'
import axios from 'axios'
import {useReviewsStore} from '@/stores/reviews'
import {useAuthStore} from '@/stores/auth'
import BaseButton from '@/components/BaseButton.vue'
import BaseModal from '@/components/BaseModal.vue'
import BaseSelect from '@/components/BaseSelect.vue'
import BaseTextarea from '@/components/BaseTextarea.vue'
import RatingStars from '@/components/RatingStars.vue'
import SectionTitle from '@/components/SectionTitle.vue'

const route = useRoute()
const reviewsStore = useReviewsStore()
const authStore = useAuthStore()

const cat = ref(null)

const catReviews = computed(() => reviewsStore.reviewsByCat(route.params.slug))
const isAuthenticated = computed(() => authStore.isAuthenticated)

const requestTypeOptions = ref([])
const requestStatusOptions = ref([])
const requestForm = reactive({
    type: '',
    purpose: ''
})
const requestErrors = reactive({
    type: '',
    purpose: ''
})
const requestMessage = ref('')
const requestError = ref('')
const existingRequest = ref(null)
const canLeaveReview = computed(
    () => isAuthenticated.value && existingRequest.value?.status?.value === 'ready'
)

const canceledStatusValues = ['canceled', 'canceled_by_user']
const canCancelRequest = computed(
    () => authStore.isAuthenticated && existingRequest.value && !canceledStatusValues.includes(existingRequest.value.status.value)
)

const isModalOpen = ref(false)
const newReview = reactive({
    rating: 5,
    text: ''
})
const formError = ref('')
const reviewMessage = ref('')
const reviewError = ref('')

const formatPrice = (value) => {
    if (value === null || value === undefined) {
        return ''
    }
    const numericValue = Number(value)
    if (Number.isNaN(numericValue)) {
        return ''
    }
    return numericValue.toLocaleString('ru-RU')
}

const load = async () => {
    const slug = route.params.slug
    if (!slug) {
        cat.value = null
        return
    }
    reviewMessage.value = ''
    try {
        const {data} = await axios.get(`/api/cats/${slug}`)
        cat.value = data.data
        await reviewsStore.fetchReviews(slug)
        await loadRequestData()
    } catch (error) {
        cat.value = null
    }
}

watch(() => route.params.slug, () => {
    load()
})

watch(isAuthenticated, () => {
    loadRequestData()
})

watch(isModalOpen, (value) => {
    if (value) {
        formError.value = ''
        reviewError.value = ''
    }
})

onMounted(load)

const loadRequestData = async () => {
    const slug = route.params.slug
    if (!slug) {
        cat.value = null
        return
    }
    if (!authStore.isAuthenticated || !cat.value) {
        existingRequest.value = null
        requestTypeOptions.value = []
        requestStatusOptions.value = []
        return
    }
    try {
        const {data} = await axios.get(`/api/cats/${slug}/request`)
        requestTypeOptions.value = data.types
        requestStatusOptions.value = data.statuses
        existingRequest.value = data.request
    } catch (error) {
        existingRequest.value = null
    }
}

const resetRequestErrors = () => {
    requestErrors.type = ''
    requestErrors.purpose = ''
    requestMessage.value = ''
    requestError.value = ''
}

const submitRequest = async () => {
    const slug = route.params.slug
    if (!slug) {
        cat.value = null
        return
    }
    if (!cat.value) {
        return
    }
    resetRequestErrors()
    try {
        await axios.post(`/api/cats/${slug}/request`, {
            type: requestForm.type,
            purpose: requestForm.purpose
        })
        requestMessage.value = 'Заявка отправлена. Мы свяжемся с вами в ближайшее время.'
        requestForm.type = ''
        requestForm.purpose = ''
        await loadRequestData()
    } catch (error) {
        const response = error?.response?.data
        if (response?.errors) {
            if (response.errors.type?.length) {
                requestErrors.type = response.errors.type[0]
            }
            if (response.errors.purpose?.length) {
                requestErrors.purpose = response.errors.purpose[0]
            }
        }
        if (!requestErrors.type && !requestErrors.purpose) {
            requestError.value = response?.message || 'Не удалось отправить заявку.'
        }
    }
}

const cancelError = ref('')
const cancelRequest = async () => {
    const slug = route.params.slug
    if (!slug) {
        cat.value = null
        return
    }
    cancelError.value = ''
    try {
        await axios.post(`/api/cats/${slug}/request/cancel`)
        await loadRequestData()
    } catch (error) {
        cancelError.value = error?.response?.data?.message || 'Не удалось отменить заявку.'
    }
}

const submitReview = async () => {
    const slug = route.params.slug
    if (!slug) {
        return
    }
    if (!canLeaveReview.value) {
        formError.value = 'Оставить отзыв можно только после готовой заявки.'
        return
    }
    if (!newReview.text) {
        formError.value = 'Введите текст отзыва.'
        return
    }
    formError.value = ''
    reviewMessage.value = ''
    reviewError.value = ''
    try {
        await reviewsStore.submitReview(slug, {
            rating: newReview.rating,
            comment: newReview.text
        })
        reviewMessage.value = 'Отзыв отправлен на модерацию.'
        newReview.text = ''
        newReview.rating = 5
        await reviewsStore.fetchReviews(slug)
        isModalOpen.value = false
    } catch (error) {
        const response = error?.response?.data
        if (response?.errors?.comment?.length) {
            formError.value = response.errors.comment[0]
            return
        }
        reviewError.value = response?.message || 'Не удалось отправить отзыв.'
    }
}
</script>
