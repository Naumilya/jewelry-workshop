<script setup>
import CardProduct from "@/components/Card/CardProduct.vue";
import { useCartStore } from "@/stores/cart.store.js";
import { useUserStore } from "@/stores/user.store.js";
import axios from "axios";
import { computed } from "vue";
import { useRouter } from "vue-router";

const cartStore = useCartStore();
const userStore = useUserStore();
const router = useRouter();

const cart = computed(() => cartStore.cart);
const totalSum = computed(() => {
    const sum = cart.value.reduce(
        (acc, product) => acc + (parseFloat(product.cost) || 0),
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

        const response = await axios.post("/api/orders", {
            user_id: userStore.id,
            products: cart.value,
        });

        if (response.data.status === "success") {
            const orderIds = response.data.orderIds;
            // Переносим очистку корзины после перенаправления
            router
                .push({
                    path: "/payment",
                    query: {
                        status: response.data.status,
                        orderIds: orderIds.join(","),
                        totalSum: totalSum.value,
                    },
                })
                .then(() => {
                    cartStore.clearCart();
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
@import "/resources/css/variables.scss";

.cart-summary {
    margin-top: 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;

    @media #{$mq-md} {
        flex-direction: column;
        gap: 30px;
    }
}
</style>
