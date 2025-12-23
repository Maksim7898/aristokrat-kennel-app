<template>
    <div class="min-h-screen bg-sand text-midnight">
        <SiteHeader/>
        <main class="pt-6">
            <slot/>
        </main>
        <SiteFooter/>
    </div>
</template>

<script setup>
import SiteHeader from '@/components/SiteHeader.vue'
import SiteFooter from '@/components/SiteFooter.vue'
</script>
