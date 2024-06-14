<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
import { useRoute, useRouter } from "vue-router";

const password = ref("");
const passwordConfirmation = ref("");
const errorMessage = ref("");
const successMessage = ref("");
const token = ref("");
const email = ref("");

const passwordError = ref("");
const confirmPasswordError = ref("");

const route = useRoute();
const router = useRouter();

onMounted(() => {
    token.value = route.params.token;
    email.value = decodeURIComponent(route.query.email); // Декодируем email из параметра запроса
});

const validate = () => {
    passwordError.value = "";
    confirmPasswordError.value = "";

    let isValid = true;

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

    if (!passwordConfirmation.value) {
        confirmPasswordError.value = "Пожалуйста, подтвердите пароль.";
        isValid = false;
    } else if (passwordConfirmation.value !== password.value) {
        confirmPasswordError.value = "Пароли не совпадают.";
        isValid = false;
    }

    return isValid;
};

async function resetPassword() {
    if (!validate()) {
        return;
    }

    try {
        const response = await axios.post("/api/password/reset", {
            token: token.value,
            email: email.value,
            password: password.value,
            password_confirmation: passwordConfirmation.value,
        });

        if (response.data.success) {
            successMessage.value = response.data.message;
            // Пауза перед редиректом для отображения сообщения об успехе
            setTimeout(() => {
                router.push("/login");
            }, 2000); // 2 секунды
        } else {
            errorMessage.value = response.data.message;
        }
    } catch (error) {
        errorMessage.value =
            "Ну удалось восстановить пароль. Пожалуйста попробуйте снова.";
    }
}
</script>

<template>
    <div>
        <h2>Восстановить пароль</h2>
        <form @submit.prevent="resetPassword" class="form">
            <div class="form__item">
                <label for="password" class="form__label">Новый пароль</label>
                <input
                    id="password"
                    type="password"
                    v-model="password"
                    class="form__input"
                />
                <p class="form__error" v-if="passwordError">
                    {{ passwordError }}
                </p>
            </div>
            <div class="form__item">
                <label for="password_confirmation" class="form__label"
                    >Подтвердить пароль</label
                >
                <input
                    id="password_confirmation"
                    type="password"
                    v-model="passwordConfirmation"
                    class="form__input"
                />
                <p class="form__error" v-if="confirmPasswordError">
                    {{ confirmPasswordError }}
                </p>
            </div>
            <p class="form__error" v-if="errorMessage">{{ errorMessage }}</p>
            <p class="form__success" v-if="successMessage">
                {{ successMessage }} Переход на страницу входа через 2
                секунды...
            </p>
            <button type="submit" class="button">Восстановить пароль</button>
        </form>
    </div>
</template>
