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
            </div>
        </div>

        <div class="mt-12 rounded-3xl bg-white p-6 shadow-soft">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <SectionTitle
                    eyebrow="Отзывы"
                    title="Отзывы владельцев"
                    subtitle="Мы ценим честный опыт наших клиентов и постоянно совершенствуем сервис."
                />
                <BaseButton @click="isModalOpen = true">Добавить отзыв</BaseButton>
            </div>
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
import BaseButton from '@/components/BaseButton.vue'
import BaseModal from '@/components/BaseModal.vue'
import BaseTextarea from '@/components/BaseTextarea.vue'
import RatingStars from '@/components/RatingStars.vue'
import SectionTitle from '@/components/SectionTitle.vue'

const route = useRoute()
const reviewsStore = useReviewsStore()

const cat = ref(null)

const catReviews = computed(() => reviewsStore.reviewsByCat(route.params.slug))

const isModalOpen = ref(false)
const newReview = reactive({
    rating: 5,
    text: ''
})
const formError = ref('')

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
    try {
        const {data} = await axios.get(`/api/cats/${slug}`)
        cat.value = data.data
    } catch (error) {
        cat.value = null
    }
}

watch(() => route.params.slug, () => {
    load()
})

onMounted(load)

const submitReview = () => {
    if (!newReview.text) {
        formError.value = 'Введите текст отзыва.'
        return
    }
    reviewsStore.addReview({
        slug: route.params.slug,
        author: 'Новый клиент',
        text: newReview.text,
        rating: newReview.rating,
        date: new Date().toLocaleDateString('ru-RU')
    })
    formError.value = ''
    newReview.text = ''
    newReview.rating = 5
    isModalOpen.value = false
}
</script>
