<template>
    <footer class="mt-16 bg-midnight text-white">
        <div class="section-shell grid gap-8 py-10 md:grid-cols-[1.2fr_1fr_1fr]">
            <div>
                <p class="font-display text-2xl">Питомник «Аристократ»</p>
                <p class="mt-3 text-sm text-white/70">
                    Элитная платформа для ценителей породистых кошек, где каждая история начинается с чемпионской
                    родословной и заботы.
                </p>
            </div>
            <div class="space-y-2 text-sm">
                <p class="text-white/60">Навигация</p>
                <ul class="space-y-2">
                    <li>
                        <RouterLink to="/cats" class="hover:text-gold">Каталог котят</RouterLink>
                    </li>
                    <li>
                        <RouterLink to="/blog" class="hover:text-gold">Блог</RouterLink>
                    </li>
                    <li>
                        <RouterLink to="/contacts" class="hover:text-gold">Контакты</RouterLink>
                    </li>
                </ul>
            </div>
            <div class="space-y-2 text-sm">
                <p class="text-white/60">Связаться</p>
                <p>Москва, ул. Моховая, 12</p>
                <p>+7 (925) 812-45-90</p>
                <p>hello@aristocrat-cats.ru</p>
            </div>
        </div>
        <div class="border-t border-white/10 py-4 text-center text-xs text-white/50">
            © 2025 «Аристократ». Все права защищены.
        </div>
    </footer>
</template>
