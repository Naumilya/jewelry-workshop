<script setup>
import { useCartStore } from "@/stores/cart.store.js";
import { useUserStore } from "@/stores/user.store.js";
import { computed, ref } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";

const router = useRouter();
const paymentStatus = ref(null);
const transactionId = ref(null);

const userStore = useUserStore();
const cartStore = useCartStore();
const userEmail = computed(() => userStore.email);

// Функция для вычисления общей суммы продуктов в корзине
function calculateTotalSum(products) {
    return products
        .reduce((acc, product) => {
            return acc + (product.cost ? parseFloat(product.cost) : 0);
        }, 0)
        .toFixed(2);
}

// Форматированная общая сумма продуктов в корзине
const formattedTotalSum = computed(() => {
    const totalSum = calculateTotalSum(cartStore.cart);
    return totalSum + " руб.";
});

// Функция для создания заказа
async function makeOrder(email) {
    try {
        const response = await axios.post("/api/orders", {
            user_id: userStore.id,
            products: cartStore.cart, // Отправляем все продукты из корзины
        });

        if (response.data.status === "success") {
            paymentStatus.value = "success";
            transactionId.value = response.data.transactionId;
            cartStore.clearCart(); // Очищаем корзину после успешной оплаты
        } else {
            paymentStatus.value = "failed";
        }
    } catch (error) {
        console.error("Error during order processing:", error);
        alert(
            "An error occurred while processing your order. Please try again."
        );
        paymentStatus.value = "failed";
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
            <p v-if="transactionId">Transaction ID: {{ transactionId }}</p>
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
