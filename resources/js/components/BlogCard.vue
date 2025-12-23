<template>
    <RouterLink :to="`/blog/${post.slug}`" class="card-hover block rounded-3xl bg-white p-4 shadow-soft">
        <img :src="post.image_url" :alt="post.title" class="h-44 w-full rounded-2xl object-cover"/>
        <div class="mt-4 space-y-2">
            <div class="flex items-center justify-between text-xs text-midnight/50">
                <span>{{ post.category.name }}</span>
                <span>{{ post.created_at }}</span>
            </div>
            <h3 class="font-display text-xl">{{ post.title }}</h3>
            <p class="text-sm text-midnight/70">{{ post.excerpt }}</p>
            <p class="text-xs text-midnight/40">Просмотров: {{ post.views }}</p>
        </div>
    </RouterLink>
</template>

<script setup>
defineProps({
    post: Object
})
</script>
