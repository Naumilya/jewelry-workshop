<script setup>
import { useUserStore } from "@/stores/user.store.js";
import axios from "axios";
import { ref } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();
const amount = ref("");
const paymentStatus = ref(null);
const transactionId = ref(null);

const userStore = useUserStore();

if (!userStore.token) {
    route.push = "/cart";
}

async function submitPayment() {
    try {
        const response = await axios.post("/api/payment", {
            amount: amount.value,
        });
        paymentStatus.value = response.data.status;
        transactionId.value = response.data.transactionId;
        console.log(paymentStatus.value);
    } catch (error) {
        console.error("Payment failed:", error);
    }
}
</script>

<template>
    <section class="container">
        <div v-if="!paymentStatus" class="payment">
            <h1>Форма оплаты</h1>
            <form @submit.prevent="submitPayment" class="form">
                <div class="form__item">
                    <label class="form__label" for="amount">Оплата:</label>
                    <input
                        class="form__input"
                        type="number"
                        id="amount"
                        v-model="amount"
                        required
                    />
                </div>
                <button class="button" type="submit">Оплатить</button>
            </form>
        </div>
        <div v-else class="payment">
            <h1>Результат оплаты</h1>
            <h2 v-if="paymentStatus === 'success'">Успешно!</h2>
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
</style>
