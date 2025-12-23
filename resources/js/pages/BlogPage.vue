<template>
    <section class="section-shell">
        <SectionTitle
            eyebrow="Блог"
            title="Истории и экспертиза питомника"
            subtitle="Свежие материалы о породах, выставках и сервисе «Аристократ»."
        />

        <div class="mt-8 grid gap-6 md:grid-cols-2">
            <BlogCard v-for="post in posts" :key="post.id" :post="post"/>
        </div>
    </section>
</template>

<script setup>
import {onMounted, ref} from 'vue'
import axios from 'axios'
import BlogCard from '@/components/BlogCard.vue'
import SectionTitle from '@/components/SectionTitle.vue'

const posts = ref([])

const load = async () => {
    try {
        const {data} = await axios.get('/api/posts')
        posts.value = data.data
    } catch (error) {
        posts.value = []
    }
}

onMounted(load)
</script>
