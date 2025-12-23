<template>
    <div class="flex items-center gap-1">
        <button
            v-for="star in 5"
            :key="star"
            class="text-lg"
            :class="star <= rating ? 'text-gold' : 'text-midnight/20'"
            @click="$emit('update:rating', star)"
            :disabled="readonly"
            type="button"
        >
            ★
        </button>
    </div>
</template>

<script setup>
defineProps({
    rating: {
        type: Number,
        default: 0
    },
    readonly: Boolean
})

defineEmits(['update:rating'])
</script>
