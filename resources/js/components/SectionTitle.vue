<template>
    <div class="space-y-2">
        <p class="text-xs uppercase tracking-[0.3em] text-gold">{{ eyebrow }}</p>
        <h2 class="font-display text-3xl text-midnight md:text-4xl">{{ title }}</h2>
        <p v-if="subtitle" class="max-w-2xl text-sm text-midnight/70">{{ subtitle }}</p>
    </div>
</template>

<script setup>
defineProps({
    eyebrow: {
        type: String,
        default: 'Аристократ'
    },
    title: String,
    subtitle: String
})
</script>
