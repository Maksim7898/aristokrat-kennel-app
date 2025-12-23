<template>
    <section class="section-shell">
        <div v-if="post" class="space-y-6">
            <div class="rounded-3xl bg-white p-8 shadow-soft">
                <div class="flex flex-wrap items-center gap-4 text-xs text-midnight/50">
                    <span class="rounded-full bg-gold/20 px-4 py-2 text-midnight">{{ post.category.name }}</span>
                    <span>{{ post.created_at }}</span>
                    <span>Просмотров: {{ post.views }}</span>
                </div>
                <h1 class="mt-4 font-display text-4xl">{{ post.title }}</h1>
                <div class="mt-4 text-sm text-midnight/60">
                    Автор: <strong class="text-midnight">{{ post.author.full_name }}</strong>, {{ post.author.role }}
                </div>
            </div>
            <img :src="post.image_url" :alt="post.title" class="h-96 w-full rounded-3xl object-cover"/>
            <div class="rounded-3xl bg-white p-8 shadow-soft">
                <div class="post-content space-y-4 text-sm text-midnight/70" v-html="post.content"/>
            </div>
        </div>
    </section>
</template>

<script setup>
import {onMounted, ref, watch} from 'vue'
import {useRoute} from 'vue-router'
import axios from 'axios'

const route = useRoute()
const post = ref(null)

const load = async () => {
    const slug = route.params.slug
    if (!slug) {
        post.value = null
        return
    }
    try {
        const {data} = await axios.get(`/api/posts/${slug}`)
        post.value = data.data
    } catch (error) {
        post.value = null
    }
}

watch(() => route.params.slug, () => {
    load()
})

onMounted(load)
</script>
