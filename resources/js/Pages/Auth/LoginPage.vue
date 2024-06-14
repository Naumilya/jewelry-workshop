<script setup>
import { useUserStore } from "@/stores/user.store.js";
import { Icon } from "@iconify/vue/dist/iconify.js";

import axios from "axios";
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";

const userStore = useUserStore();

const recaptchaToken = ref("");
const recaptchaContainer = ref(null);
const recaptchaKey = ref(import.meta.env.VITE_GOOGLE_RECAPTCHA_KEY || "");

const email = ref("");
const password = ref("");

const emailError = ref("");
const passwordError = ref("");
const serverError = ref("");

const router = useRouter();

const validate = () => {
    emailError.value = "";
    passwordError.value = "";

    let isValid = true;

    if (!email.value) {
        emailError.value = "Пожалуйста, введите почту.";
        isValid = false;
    } else if (!/\S+@\S+\.\S+/.test(email.value)) {
        emailError.value = "Пожалуйста, введите правильный формат почты.";
        isValid = false;
    }

    if (!password.value) {
        passwordError.value = "Пожалуйста, введите пароль.";
        isValid = false;
    } else if (password.value.length < 6) {
        passwordError.value = "Пароль должен содержать не менее 6 символов.";
        isValid = false;
    }

    return isValid;
};

const login = async () => {
    if (!validate()) {
        return;
    }

    serverError.value = "";

    try {
        const response = await axios.post("/api/login", {
            email: email.value,
            password: password.value,
            recaptchaToken: recaptchaToken.value, // Передаем recaptchaToken
        });

        if (response.data.success) {
            userStore.setUser(response.data.data);
            router.push("/");
        } else {
            serverError.value =
                response.data.message ||
                "Произошла ошибка. Попробуйте еще раз.";
        }
    } catch (error) {
        serverError.value = "Произошла ошибка. Попробуйте еще раз.";
        console.error(error);
    }
};

onMounted(() => {
    if (userStore.token) {
        router.push("/profile");
    }
    if (recaptchaKey.value && recaptchaContainer.value) {
        grecaptcha.ready(() => {
            grecaptcha.render(recaptchaContainer.value, {
                sitekey: recaptchaKey.value,
                callback: (token) => (recaptchaToken.value = token),
            });
        });
    }
});
</script>

<template>
    <h2>Войти в аккаунт</h2>
    <form @submit.prevent="login" class="form">
        <div class="form__item">
            <label class="form__label" for="email">Почта</label>
            <input
                id="email"
                class="form__input"
                type="email"
                placeholder="Почта"
                v-model="email"
            />
            <p class="form__error" v-if="emailError">{{ emailError }}</p>
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
            <p class="form__error" v-if="passwordError">{{ passwordError }}</p>
        </div>
        <div class="form__item">
            <div
                data-theme="dark"
                ref="recaptchaContainer"
                class="g-recaptcha captcha"
            ></div>
        </div>
        <p class="form__error" v-if="serverError">{{ serverError }}</p>
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
