<template>
    <RouterLink :to="`/cats/${cat.slug}`" class="card-hover block rounded-3xl bg-white p-4 shadow-soft">
        <img :src="cat.image_url" :alt="cat.name" class="h-48 w-full rounded-2xl object-cover"/>
        <div class="mt-4 space-y-2">
            <div class="flex items-center justify-between">
                <h3 class="font-display text-xl">{{ cat.name }}</h3>
                <span class="text-sm text-gold">{{ formatPrice(cat.price) }} ₽</span>
            </div>
            <div class="text-xs text-midnight/60">
                <p>Пол: {{ cat.gender }}</p>
                <p>Класс: {{ cat.class.name }}</p>
                <p>Порода: {{ cat.breed.name }}</p>
                <p>Статус: {{ cat.status }}</p>
            </div>
        </div>
    </RouterLink>
</template>

<script setup>
defineProps({
    cat: Object
})

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
</script>
