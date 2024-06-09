<script setup></script>

<template>
    <section class="error container">
        <h1>404</h1>
        <h2>Страница не найдена...</h2>
        <router-link to="/" class="button button_transparent">
            На главную
        </router-link>
    </section>
</template>

<style lang="scss" scoped>
.error {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

h2 {
    margin-bottom: 40px;
}
</style>
