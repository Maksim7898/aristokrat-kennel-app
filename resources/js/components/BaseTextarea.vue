<template>
    <div class="space-y-2">
        <label v-if="label" class="text-sm font-medium text-midnight/70">{{ label }}</label>
        <textarea
            :value="modelValue"
            :placeholder="placeholder"
            rows="4"
            class="w-full rounded-2xl border border-midnight/10 bg-white px-4 py-3 text-sm shadow-sm focus:border-gold focus:outline-none focus:ring-2 focus:ring-gold/30"
            @input="$emit('update:modelValue', $event.target.value)"
        />
        <p v-if="error" class="text-xs text-rose-500">{{ error }}</p>
    </div>
</template>

<script setup>
defineProps({
    modelValue: String,
    label: String,
    placeholder: String,
    error: String
})

defineEmits(['update:modelValue'])
</script>
