<template>
    <section class="section-shell">
        <div class="grid gap-8 rounded-3xl bg-white p-8 shadow-soft md:grid-cols-[1.1fr_0.9fr]">
            <div>
                <SectionTitle
                    eyebrow="Контакты"
                    title="Свяжитесь с нами в удобном формате"
                    subtitle="Мы отвечаем на заявки в течение рабочего дня и рады обсудить подбор котёнка или участие в выставках."
                />
                <div class="mt-8 space-y-4 text-sm text-midnight/70">
                    <p><strong class="text-midnight">Адрес:</strong> Москва, ул. Спиридоновка, 24</p>
                    <p><strong class="text-midnight">Телефон:</strong> +7 (495) 948-12-56</p>
                    <p><strong class="text-midnight">Email:</strong> concierge@aristocrat-cats.ru</p>
                    <p><strong class="text-midnight">График:</strong> Пн–Сб, 10:00–20:00</p>
                </div>
            </div>
            <div class="rounded-3xl bg-sand p-6">
                <h3 class="font-display text-2xl">Премиальный сервис</h3>
                <p class="mt-4 text-sm text-midnight/70">
                    Для бронирования котёнка заполните анкету в личном кабинете. Мы подготовим персональную
                    консультацию и договор.
                </p>
                <div class="mt-6 space-y-4 text-sm">
                    <div class="glass-panel rounded-2xl p-4">
                        <p class="text-midnight">Сопровождение по выставкам</p>
                    </div>
                    <div class="glass-panel rounded-2xl p-4">
                        <p class="text-midnight">Персональный менеджер</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import SectionTitle from '@/components/SectionTitle.vue'
</script>
