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
@import "/resources/css/variables.scss";

.error {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;

    @media #{$mq-md} {
        text-align: center;
    }
}

h2 {
    margin-bottom: 40px;
}
</style>
