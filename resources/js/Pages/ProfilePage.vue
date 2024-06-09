<script setup>
import { useUserStore } from "@/stores/user.store.js";
import { onMounted } from "vue";
import { useRouter } from "vue-router";
const userStore = useUserStore();
const router = useRouter();

const logout = () => {
    userStore.logout();
    router.push("/login");
};

onMounted(() => {
    if (!userStore.token) {
        router.push("/login");
    }
});
</script>

<template>
    <section class="user-info container">
        <h1>Профиль</h1>
        <div class="user-info__about">
            <div class="user-info__name">
                <h2>{{ userStore.name }}</h2>
                <p class="user-info__date">
                    Дата регистрации:
                    {{ userStore.getFormattedDate() }}
                </p>
            </div>
            <div class="user-info__email">
                <h2>Почта:</h2>
                {{ userStore.email }}
            </div>
        </div>
    </section>
    <section class="orders container">
        <h2>Мои заказы</h2>
        <div class="orders__empty" v-if="true">
            <span> Здесь пока что ничего нет... </span>
            <router-link to="/catalog">Перейти в Каталог</router-link>
        </div>
        <div class="orders__list" v-else></div>
    </section>
    <section class="logout container">
        <form @submit.prevent="logout" class="logout">
            <button type="submit" class="button button_transparent">
                Выйти из аккаунта
            </button>
        </form>
    </section>
</template>

<style lang="scss" scoped>
@import "/resources/css/variables.scss";

.user-info {
    &__about {
        margin-top: 32px;
        display: flex;
        align-items: center;
        gap: 130px;
    }

    &__email {
        font-size: 24px;
        font-weight: 300;
        font-family: Raleway, sans-serif;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    &__date {
        color: $color-gray;
    }
}

.orders {
    margin-top: 40px;

    &__empty {
        margin-top: 40px;
        font-size: 24px;
        font-weight: 300;
        display: flex;
        gap: 15px;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
}

.logout {
    margin-top: 40px;
    display: flex;
    justify-content: end;
}
</style>
