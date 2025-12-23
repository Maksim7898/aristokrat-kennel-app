<template>
    <section class="section-shell">
        <SectionTitle
            eyebrow="Каталог"
            title="Наши котята"
            subtitle="Премиальные котята с прозрачным статусом и чемпионскими перспективами."
        />

        <div class="mt-8 grid gap-6 lg:grid-cols-[280px_1fr] items-start">
            <aside class="rounded-3xl bg-white p-5 shadow-soft">
                <h3 class="font-display text-xl">Фильтры</h3>
                <div class="mt-5 space-y-4">
                    <BaseSelect
                        v-model="filters.class"
                        label="Класс кота"
                        placeholder="Все классы"
                        :options="classOptions"
                    />
                    <BaseSelect
                        v-model="filters.status"
                        label="Статус"
                        placeholder="Все статусы"
                        :options="statusOptions"
                    />
                    <BaseSelect
                        v-model="filters.breed"
                        label="Порода кота"
                        placeholder="Все породы"
                        :options="breedOptions"
                    />
                    <BaseSelect
                        v-model="filters.gender"
                        label="Пол кота"
                        placeholder="Все полы"
                        :options="genderOptions"
                    />
                    <div class="grid gap-3">
                        <BaseInput
                            v-model="filters.priceFrom"
                            label="Цена от"
                            :placeholder="priceFromPlaceholder"
                        />
                        <BaseInput
                            v-model="filters.priceTo"
                            label="Цена до"
                            :placeholder="priceToPlaceholder"
                        />
                    </div>
                </div>
            </aside>

            <div class="grid gap-6 md:grid-cols-2">
                <CatCard v-for="cat in cats" :key="cat.id" :cat="cat"/>
            </div>
        </div>
    </section>
</template>

<script setup>
import {computed, onMounted, reactive, ref, watch} from 'vue'
import axios from 'axios'
import BaseInput from '@/components/BaseInput.vue'
import BaseSelect from '@/components/BaseSelect.vue'
import CatCard from '@/components/CatCard.vue'
import SectionTitle from '@/components/SectionTitle.vue'

const filters = reactive({
    class: '',
    status: '',
    breed: '',
    gender: '',
    priceFrom: '',
    priceTo: ''
})

const cats = ref([])

const classOptions = ref([])
const breedOptions = ref([])
const statusOptions = ref([])
const genderOptions = ref([])
const priceRange = ref(null)

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

const priceFromPlaceholder = computed(() => formatPrice(priceRange.value?.min_price))
const priceToPlaceholder = computed(() => formatPrice(priceRange.value?.max_price))

const buildParams = () => ({
    ...(filters.class ? {class: filters.class} : {}),
    ...(filters.status ? {status: filters.status} : {}),
    ...(filters.breed ? {breed: filters.breed} : {}),
    ...(filters.gender ? {gender: filters.gender} : {}),
    ...(filters.priceFrom ? {priceFrom: filters.priceFrom} : {}),
    ...(filters.priceTo ? {priceTo: filters.priceTo} : {})
})

const load = async () => {
    try {
        const {data} = await axios.get('/api/cats', {
            params: buildParams()
        })
        cats.value = data.data
    } catch (error) {
        cats.value = []
    }
}

const loadFilters = async () => {
    try {
        const {data} = await axios.get('/api/cats/get/filters')
        const normalizeOptions = (options) => {
            if (Array.isArray(options)) {
                return options
            }
            if (options && Array.isArray(options.data)) {
                return options.data
            }
            return []
        }
        classOptions.value = normalizeOptions(data.classes)
        breedOptions.value = normalizeOptions(data.breeds)
        statusOptions.value = normalizeOptions(data.statuses)
        genderOptions.value = normalizeOptions(data.genders)
        priceRange.value = data.priceRange
    } catch (error) {
        classOptions.value = []
        breedOptions.value = []
        statusOptions.value = []
        genderOptions.value = []
        priceRange.value = null
    }
}

onMounted(() => {
    load()
    loadFilters()
})

let loadTimeout = null
watch(
    filters,
    () => {
        if (loadTimeout) {
            clearTimeout(loadTimeout)
        }
        loadTimeout = setTimeout(() => {
            load()
        }, 300)
    },
    {deep: true}
)
</script>
