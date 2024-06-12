<script setup>
import { useUserStore } from "@/stores/user.store.js";
import { Icon } from "@iconify/vue/dist/iconify.js";
import axios from "axios";
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";

const userStore = useUserStore();

const name = ref("");
const email = ref("");
const password = ref("");
const confirmPassword = ref("");
const nameError = ref("");
const emailError = ref("");
const passwordError = ref("");
const confirmPasswordError = ref("");
const serverError = ref("");

const router = useRouter();

const validate = () => {
    nameError.value = "";
    emailError.value = "";
    passwordError.value = "";
    confirmPasswordError.value = "";
    serverError.value = "";

    let isValid = true;

    if (!name.value) {
        nameError.value = "Пожалуйста, введите полное имя.";
        isValid = false;
    }

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
    } else if (password.value.length < 8) {
        passwordError.value = "Пароль должен содержать не менее 8 символов.";
        isValid = false;
    } else if (!/[A-Z]/.test(password.value)) {
        passwordError.value =
            "Пароль должен содержать минимум одну заглавную букву.";
        isValid = false;
    } else if (!/[a-z]/.test(password.value)) {
        passwordError.value =
            "Пароль должен содержать минимум одну строчную букву.";
        isValid = false;
    } else if (!/[0-9]/.test(password.value)) {
        passwordError.value = "Пароль должен содержать минимум одну цифру.";
        isValid = false;
    } else if (!/[!@#$%^&*(),.?":{}|<>]/.test(password.value)) {
        passwordError.value =
            "Пароль должен содержать минимум один специальный символ.";
        isValid = false;
    }

    if (!confirmPassword.value) {
        confirmPasswordError.value = "Пожалуйста, подтвердите пароль.";
        isValid = false;
    } else if (confirmPassword.value !== password.value) {
        confirmPasswordError.value = "Пароли не совпадают.";
        isValid = false;
    }

    return isValid;
};

const register = async () => {
    if (!validate()) {
        return;
    }

    try {
        const response = await axios.post("/api/register", {
            name: name.value,
            email: email.value,
            password: password.value,
            password_confirmation: confirmPassword.value,
        });
        console.log(response.data);
        userStore.setUser(response.data.data);
        router.push("/");
    } catch (error) {
        if (
            error.response &&
            error.response.data &&
            error.response.data.message
        ) {
            serverError.value = error.response.data.message;
        } else {
            serverError.value = "Произошла ошибка. Попробуйте еще раз.";
        }
        console.error(error);
    }
};

onMounted(() => {
    if (userStore.token) {
        router.push("/profile");
    }
});
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
            <p class="form__error" v-if="nameError">{{ nameError }}</p>
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
            <p class="form__error" v-if="confirmPasswordError">
                {{ confirmPasswordError }}
            </p>
        </div>
        <p class="form__error" v-if="serverError">{{ serverError }}</p>
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

<style lang="scss" scoped>
.form__error {
    color: red;
    font-size: 0.875rem;
    margin-top: 0.5rem;
}
</style>
