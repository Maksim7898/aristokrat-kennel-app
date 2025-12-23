<template>
    <div class="space-y-2">
        <label v-if="label" class="text-sm font-medium text-midnight/70">{{ label }}</label>
        <select
            :value="modelValue"
            class="w-full rounded-2xl border border-midnight/10 bg-white px-4 py-3 text-sm shadow-sm focus:border-gold focus:outline-none focus:ring-2 focus:ring-gold/30"
            @change="$emit('update:modelValue', $event.target.value)"
        >
            <option value="">{{ placeholder }}</option>
            <option
                v-for="option in options"
                :key="String(getOptionValue(option))"
                :value="getOptionValue(option)"
            >
                {{ getOptionLabel(option) }}
            </option>
        </select>
        <p v-if="error" class="text-xs text-rose-500">{{ error }}</p>
    </div>
</template>

<script setup>
defineProps({
    modelValue: [String, Number],
    label: String,
    placeholder: {
        type: String,
        default: 'Выберите'
    },
    options: {
        type: Array,
        default: () => []
    },
    error: String
})

const getOptionValue = (option) => {
    if (option && typeof option === 'object') {
        if ('value' in option) {
            return option.value
        }
        if ('id' in option) {
            return option.id
        }
    }
    return option
}

const getOptionLabel = (option) => {
    if (option && typeof option === 'object') {
        if ('label' in option) {
            return option.label
        }
        if ('name' in option) {
            return option.name
        }
    }
    return option
}

defineEmits(['update:modelValue'])
</script>
