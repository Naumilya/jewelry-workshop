<script setup>
import { useCartStore } from "@/stores/cart.store.js";
import { useUserStore } from "@/stores/user.store.js";
import { computed, ref } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const amount = ref("");
const paymentStatus = ref(null);
const transactionId = ref(null);

const userStore = useUserStore();
const cartStore = useCartStore();
const userEmail = computed(() => userStore.email);
const formattedTotalSum = computed(() => {
    const totalSum = userStore.orders.reduce(
        (acc, order) => acc + order.totalSum,
        0
    );
    return `${totalSum} руб.`;
});

if (!userStore.token) {
    router.push = "/cart";
}

async function makeOrder(email) {
    try {
        // здесь можно добавить логику отправки заказа на сервер или в профиль пользователя
        console.log("Order made:", email);
        // очищаем корзину
        cartStore.clearCart();
        router.push("/");
    } catch (error) {
        console.error("Payment failed:", error);
    }
}
</script>

<template>
    <section class="container">
        <div v-if="!paymentStatus" class="payment">
            <h1>Форма оплаты</h1>
            <form @submit.prevent="makeOrder(userStore.email)" class="form">
                <div class="form__item">
                    <p class="form__text">
                        Общая сумма: <span>{{ formattedTotalSum }}</span>
                    </p>
                    <p class="form__text">Ваша почта: {{ userEmail }}</p>
                </div>
                <button class="button" type="submit">Оплатить</button>
            </form>
        </div>
        <div v-else class="payment">
            <h1>Результат оплаты</h1>
            <h2 v-if="paymentStatus === 'success'">
                Успешно!
                <router-link to="/">Перейти на главную</router-link>
            </h2>
            <h2 v-else>Оплата не удалась. Попробуйте снова.</h2>
            <p>Transaction ID: {{ transactionId }}</p>
        </div>
    </section>
</template>

<style scoped lang="scss">
.payment {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.form__text {
    font-size: 24px;

    span {
        text-decoration: underline;
    }
}

.form__text + .form__text {
    margin-top: 20px;
}
</style>
