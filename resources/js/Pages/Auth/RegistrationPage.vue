<script setup>
import { Icon } from "@iconify/vue/dist/iconify.js";
</script>

<template>
    <h2>Регистрация</h2>
    <form action="post" class="form">
        <div class="form__item">
            <label class="form__label" for="name">Полное имя</label>
            <input
                class="form__input"
                id="name"
                type="text"
                placeholder="Полное имя"
            />
        </div>
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
        <div class="form__item">
            <label class="form__label" for="confirmPassword">
                Подтверждение пароля
            </label>
            <input
                id="confirmPassword"
                type="password"
                class="form__input"
                placeholder="Подтверждение пароля"
            />
        </div>
        <div class="form__actions">
            <div class="form__socials">
                <p>Регистрация с помощью</p>
                <a href=""><Icon icon="ion:logo-google"></Icon></a>
                <a href=""><Icon icon="ion:logo-vk"></Icon></a>
            </div>
            <router-link to="/login">Уже есть аккаунт?</router-link>
        </div>
        <button class="button" type="submit">Зарегистрироваться</button>
    </form>
</template>

<style lang="scss" scoped></style>
