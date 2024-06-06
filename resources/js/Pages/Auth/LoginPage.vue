<script setup>
import { Icon } from "@iconify/vue/dist/iconify.js";
</script>

<template>
    <h2>Войти в аккаунт</h2>
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
        <div class="form__item">
            <label class="form__label" for="password">Пароль</label>
            <input
                id="password"
                class="form__input"
                type="password"
                placeholder="Пароль"
            />
        </div>
        <div class="form__actions">
            <div class="form__socials">
                <p>Регистрация с помощью</p>
                <a href=""><Icon icon="ion:logo-google"></Icon></a>
                <a href=""><Icon icon="ion:logo-vk"></Icon></a>
            </div>
            <div class="form__item">
                <router-link to="/registration"
                    >Не зарегистрированы?</router-link
                >
                <router-link to="/restore">Забыли пароль?</router-link>
            </div>
        </div>
        <button class="button" type="submit">Войти</button>
    </form>
</template>

<style lang="scss" scoped></style>
