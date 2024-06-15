<script setup>
import CardProduct from "@/components/Card/CardProduct.vue";
import { useCartStore } from "@/stores/cart.store.js";
import { useUserStore } from "@/stores/user.store.js";
import { computed } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";

const cartStore = useCartStore();
const userStore = useUserStore();
const router = useRouter();

const cart = computed(() => cartStore.cart);
const totalSum = computed(() => {
    const sum = cart.value.reduce(
        (acc, product) => acc + parseFloat(product.cost),
        0
    );

    return sum.toFixed(2);
});

const isAuthorized = computed(() => userStore.token !== null);

const handleOrder = async () => {
    try {
        if (!isAuthorized.value) {
            router.push("/login");
            return;
        }

        const email = userStore.email;
        const products = cart.value;
        // const totalSum = totalSum.value;

        const response = await axios.post("/api/orders", {
            user_id: userStore.id,
            products: products,
            // total_sum: totalSum,
        });

        if (response.data.status === "success") {
            // Clear the cart if the order is successful
            cartStore.clearCart();
            // Redirect to the payment page with transaction details
            router.push({
                path: "/payment",
                query: {
                    status: response.data.status,
                    transactionId: response.data.transactionId,
                },
            });
        } else {
            console.error("Order creation failed:", response.data.message);
            alert("Order creation failed. Please try again.");
        }
    } catch (error) {
        console.error("Error during order processing:", error);
        alert(
            "An error occurred while processing your order. Please try again."
        );
    }
};
</script>

<template>
    <section class="cart-view container">
        <h1>Корзина</h1>
        <div v-if="cart.length === 0">Ваша корзина пуста</div>
        <div class="cart" v-else>
            <div class="product-grid">
                <CardProduct
                    v-for="product in cart"
                    :key="product.id"
                    :product="product"
                    route="cart"
                />
            </div>
            <div class="cart-summary">
                <h3>Общая сумма заказа: {{ totalSum }} руб.</h3>
                <button v-if="isAuthorized" class="button" @click="handleOrder">
                    Оформить заказ
                </button>
                <router-link v-else class="button" to="/login">
                    Войдите в аккаунт
                </router-link>
            </div>
        </div>
    </section>
</template>

<style lang="scss" scoped>
.cart-summary {
    margin-top: 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
</style>
