<script setup>
import { Icon } from "@iconify/vue/dist/iconify.js";
</script>

<template>
    <h2>Восстановить пароль</h2>
    <form action="post" class="form">
        <div class="form__item">
            <label class="form__label" for="email">Почта</label>
            <input
                id="email"
                class="form__input"
                type="email"
                placeholder="Почта"
            />
        </div>
        <div class="form__actions">
            <div class="form__socials">
                <p>Войти с помощью</p>
                <a href=""><Icon icon="ion:logo-google"></Icon></a>
                <a href=""><Icon icon="ion:logo-vk"></Icon></a>
            </div>
            <router-link to="/login">Назад</router-link>
        </div>
        <button class="button" type="submit">Отправить письмо</button>
    </form>
</template>

<style lang="scss" scoped></style>
