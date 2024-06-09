<script setup>
import { Icon } from "@iconify/vue/dist/iconify.js";
import axios from "axios";
import { ref } from "vue";
import { useRouter } from "vue-router";
const name = ref("");
const email = ref("");
const password = ref("");
const confirmPassword = ref("");
const router = useRouter();
const register = async () => {
    try {
        const response = await axios.post("/api/register", {
            name: name.value,
            email: email.value,
            password: password.value,
            password_confirmation: confirmPassword.value,
        });
        console.log(response.data);
        router.push("/");
    } catch (error) {
        console.error(error);
    }
};
</script>

<template>
    <h2>Регистрация</h2>
    <form @submit.prevent="register" class="form">
        <div class="form__item">
            <label class="form__label" for="name">Полное имя</label>
            <input
                class="form__input"
                id="name"
                type="text"
                placeholder="Полное имя"
                v-model="name"
            />
        </div>
        <div class="form__item">
            <label class="form__label" for="email">Почта</label>
            <input
                id="email"
                class="form__input"
                type="email"
                placeholder="Почта"
                v-model="email"
            />
        </div>
        <div class="form__item">
            <label class="form__label" for="password">Пароль</label>
            <input
                id="password"
                class="form__input"
                type="password"
                placeholder="Пароль"
                v-model="password"
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
                v-model="confirmPassword"
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
