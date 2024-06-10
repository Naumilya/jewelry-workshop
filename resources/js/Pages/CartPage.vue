<script setup>
import CardProduct from "@/components/Card/CardProduct.vue";
import { useCartStore } from "@/stores/cart.store.js";
import { useUserStore } from "@/stores/user.store.js";
import { computed } from "vue";
import { useRouter } from "vue-router";

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
    if (!isAuthorized.value) {
        router.push("/login");
        return;
    }
    // код для оформления заказа
    console.log("можно оформить");
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
                <button class="button" @click="handleOrder">
                    Оформить заказ
                </button>
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
