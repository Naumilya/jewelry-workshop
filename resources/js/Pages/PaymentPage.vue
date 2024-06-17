<script setup>
import { useUserStore } from "@/stores/user.store.js";
import axios from "axios";
import { computed, ref } from "vue";
import { useRoute, useRouter } from "vue-router";

const router = useRouter();
const route = useRoute();
const paymentStatus = ref(null);
const orderIds = ref(
    route.query.orderIds ? route.query.orderIds.split(",") : []
);
const errorMessage = ref(null);

const userStore = useUserStore();
const userEmail = computed(() => userStore.email);
const totalSum = ref(route.query.totalSum || "0.00");

async function processPayment() {
    try {
        const updatePromises = orderIds.value.map(async (orderId) => {
            const updateResponse = await axios.post(
                "/api/orders/updateStatus",
                {
                    orderId: orderId,
                    status: "paid",
                }
            );

            if (updateResponse.data.status !== "success") {
                console.error(
                    "Order status update failed:",
                    updateResponse.data.message
                );
                throw new Error(
                    "Order status update failed. Please try again."
                );
            }
        });

        await Promise.all(updatePromises);
        paymentStatus.value = "success";
        router.push({
            path: "/payment",
            query: {
                status: "success",
                orderIds: orderIds.value.join(","),
                totalSum: totalSum.value,
            },
        });
    } catch (error) {
        console.error("Error during order status update:", error);
        errorMessage.value =
            "Error during order status update. Please try again.";
        paymentStatus.value = "failed";
    }
}
</script>

<template>
    <section class="container">
        <div v-if="!paymentStatus" class="payment">
            <h1>Форма оплаты</h1>
            <form @submit.prevent="processPayment" class="form">
                <div class="form__item">
                    <p class="form__text">
                        Общая сумма: <span>{{ totalSum }} руб.</span>
                    </p>
                    <p class="form__text">Ваша почта: {{ userEmail }}</p>
                </div>
                <button class="button" type="submit">Оплатить</button>
            </form>
            <div v-if="errorMessage" class="error-message">
                {{ errorMessage }}
            </div>
        </div>
        <div v-else class="payment">
            <h1>Результат оплаты</h1>
            <h2 v-if="paymentStatus === 'success'">
                Успешно!
                <router-link to="/">Перейти на главную</router-link>
            </h2>
            <h2 v-else>Оплата не удалась. Попробуйте снова.</h2>
            <p v-if="orderIds.length">Order IDs: {{ orderIds.join(", ") }}</p>
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

.error-message {
    color: red;
    margin-top: 20px;
}
</style>
