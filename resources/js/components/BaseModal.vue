<template>
    <div v-if="modelValue" class="fixed inset-0 z-50 flex items-center justify-center px-4">
        <div class="absolute inset-0 bg-midnight/70" @click="$emit('update:modelValue', false)"/>
        <div class="relative w-full max-w-lg rounded-3xl bg-white p-6 shadow-soft">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="font-display text-2xl text-midnight">{{ title }}</h3>
                    <p v-if="subtitle" class="mt-1 text-sm text-midnight/60">{{ subtitle }}</p>
                </div>
                <button class="text-midnight/50 hover:text-midnight" @click="$emit('update:modelValue', false)">✕
                </button>
            </div>
            <div class="mt-6">
                <slot/>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    modelValue: Boolean,
    title: String,
    subtitle: String
})

defineEmits(['update:modelValue'])
</script>
