<template>
    <button
        :type="type"
        class="inline-flex items-center justify-center cursor-pointer gap-2 rounded-full bg-gold px-6 py-3 text-sm font-semibold text-midnight shadow-soft transition hover:bg-gold/90"
    >
        <slot/>
    </button>
</template>

<script setup>
defineProps({
    type: {
        type: String,
        default: 'button'
    }
})
</script>
