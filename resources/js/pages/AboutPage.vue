<template>
    <section class="section-shell">
        <div class="rounded-3xl bg-white p-8 shadow-soft">
            <SectionTitle
                eyebrow="О породе"
                title="Породы, с которыми работает «Аристократ»"
                subtitle="Мы развиваем линии британской короткошёрстной, мейн-кун и бенгальской породы, уделяя внимание здоровью и типу."
            />
            <div class="mt-8 grid gap-6 md:grid-cols-3">
                <div v-for="breed in breeds" :key="breed.name" class="rounded-3xl bg-sand p-5">
                    <h3 class="font-display text-xl">{{ breed.name }}</h3>
                    <p class="mt-3 text-sm text-midnight/70">{{ breed.description }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import {onMounted, ref} from 'vue'
import SectionTitle from '@/components/SectionTitle.vue'
import axios from "axios";

const breeds = ref([])

const load = async () => {
    try {
        const {data} = await axios.get('/api/cats/get/breeds')
        breeds.value = data.data
    } catch (error) {
        breeds.value = []
    }
}

onMounted(load)
</script>
