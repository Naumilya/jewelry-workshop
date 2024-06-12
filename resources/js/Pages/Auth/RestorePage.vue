<script setup>
import { Icon } from "@iconify/vue";
import axios from "axios";
import { ref } from "vue";
import { useRouter } from "vue-router";

const email = ref("");
const emailError = ref("");
const serverError = ref("");
const successMessage = ref("");

const router = useRouter();

const validateEmail = () => {
    emailError.value = "";
    serverError.value = "";
    successMessage.value = "";

    let isValid = true;

    if (!email.value) {
        emailError.value = "Пожалуйста, введите почту.";
        isValid = false;
    } else if (!/\S+@\S+\.\S+/.test(email.value)) {
        emailError.value = "Пожалуйста, введите правильный формат почты.";
        isValid = false;
    }

    return isValid;
};

const sendResetEmail = async () => {
    if (!validateEmail()) {
        return;
    }

    try {
        const response = await axios.post("/api/password/email", {
            email: email.value,
        });
        successMessage.value =
            "Письмо для восстановления пароля отправлено. Проверьте свою почту.";
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
</script>

<template>
    <div>
        <h2>Восстановить пароль</h2>
        <form @submit.prevent="sendResetEmail" class="form">
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
            <p class="form__error" v-if="serverError">{{ serverError }}</p>
            <p class="form__success" v-if="successMessage">
                {{ successMessage }}
            </p>
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
    </div>
</template>

<style lang="scss" scoped></style>
