<template>
    <section class="section-shell">
        <div class="grid items-stretch gap-8 rounded-[32px] bg-midnight px-6 py-10 text-white md:grid-cols-[1.1fr_0.9fr]">
            <div class="space-y-6">
                <p class="text-xs uppercase tracking-[0.35em] text-gold">Питомник “Аристократ”</p>
                <h1 class="font-display text-4xl md:text-5xl">
                    Элитная платформа, где котёнок становится чемпионом вашей истории.
                </h1>
                <p class="text-sm text-white/70">
                    Сайт “Аристократ”— это элитная платформа, демонстрирующая кошек как настоящих чемпионов с
                    безупречной родословной. Задача сайта — привлечь серьёзных покупателей, заинтересованных в
                    выставках и разведении, и обеспечить удобный процесс выбора и резервирования котёнка через личный
                    кабинет и систему анкетирования.
                </p>
                <div class="flex flex-wrap gap-3">
                    <RouterLink to="/cats">
                        <BaseButton>Подобрать котёнка</BaseButton>
                    </RouterLink>
                </div>
            </div>
            <div class="hero-card rounded-[28px] md:p-6 h-full min-w-0">
                <Swiper
                    :modules="modules"
                    :slides-per-view="1"
                    effect="fade"
                    loop
                    :pagination="{ clickable: true }"
                    class="h-full"
                >
                    <SwiperSlide v-for="i in 3" :key="i">
                        <img :src="'/images/slides/'+ i +'.jpg'" :alt="'Слайд ' + i"
                             class="h-full aspect-video w-full rounded-3xl object-cover object-center"/>
                    </SwiperSlide>
                </Swiper>
            </div>
        </div>
    </section>

    <section class="section-shell mt-16 grid gap-8 md:grid-cols-[1fr_1fr]">
        <div class="rounded-3xl bg-white p-6 shadow-soft">
            <SectionTitle
                eyebrow="Концепция"
                title="Аристократичное пространство для серьёзных заводчиков"
                subtitle="Мы объединяем эстетику премиального сервиса, экспертное сопровождение и технологичность личного кабинета."
            />
            <div class="mt-6 space-y-4 text-sm text-midnight/70">
                <p>
                    Личный кабинет позволяет пройти анкетирование, получить индивидуальные рекомендации и закрепить
                    резервирование котёнка. Все процессы прозрачны, а документация доступна онлайн.
                </p>
                <p>
                    Команда «Аристократа» сопровождает владельцев на выставках и консультирует по племенному развитию.
                </p>
            </div>
        </div>
        <div class="rounded-3xl bg-white p-6 shadow-soft">
            <SectionTitle
                eyebrow="Сервис"
                title="Путь клиента выстроен как приватный клуб"
                subtitle="От подбора до передачи котёнка — всё в одном месте."
            />
            <ul class="mt-6 space-y-4 text-sm text-midnight/70">
                <li class="flex items-start gap-3">
                    <span class="mt-1 h-2 w-2 rounded-full bg-gold"></span>
                    Персональное кураторство и статусные консультации.
                </li>
                <li class="flex items-start gap-3">
                    <span class="mt-1 h-2 w-2 rounded-full bg-gold"></span>
                    Доступ к родословным, сертификатам и плану прививок.
                </li>
                <li class="flex items-start gap-3">
                    <span class="mt-1 h-2 w-2 rounded-full bg-gold"></span>
                    Выставочная подготовка и рекомендации по уходу.
                </li>
            </ul>
        </div>
    </section>

    <section class="section-shell mt-16">
        <SectionTitle
            eyebrow="Преимущества"
            title="Почему выбирают «Аристократ»"
            subtitle="Мы соединяем эстетику, документы и экспертность в одном пространстве."
        />
        <div class="mt-8 grid gap-6 md:grid-cols-3">
            <div class="rounded-3xl bg-white p-6 shadow-soft">
                <p class="text-xs uppercase text-gold">01</p>
                <h3 class="mt-4 font-display text-xl">Безупречная родословная</h3>
                <p class="mt-3 text-sm text-midnight/70">
                    Каждая линия подтверждена документально и подготовлена к выставочному будущему.
                </p>
            </div>
            <div class="rounded-3xl bg-white p-6 shadow-soft">
                <p class="text-xs uppercase text-gold">02</p>
                <h3 class="mt-4 font-display text-xl">Цифровое резервирование</h3>
                <p class="mt-3 text-sm text-midnight/70">
                    Удобный личный кабинет для выбора, договора и хранения материалов.
                </p>
            </div>
            <div class="rounded-3xl bg-white p-6 shadow-soft">
                <p class="text-xs uppercase text-gold">03</p>
                <h3 class="mt-4 font-display text-xl">Поддержка экспертов</h3>
                <p class="mt-3 text-sm text-midnight/70">
                    Наши специалисты помогают вам уверенно выходить на выставки и формировать разведение.
                </p>
            </div>
        </div>
    </section>
</template>

<script setup>
import {Swiper, SwiperSlide} from 'swiper/vue'
import {Autoplay, EffectFade, Pagination} from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/effect-fade'
import 'swiper/css/pagination'

import BaseButton from '@/components/BaseButton.vue'
import SectionTitle from '@/components/SectionTitle.vue'

const modules = [EffectFade, Pagination, Autoplay]
</script>
