<script setup>
import CardProduct from "@/components/Card/CardProduct.vue";
import { useCartStore } from "@/stores/cart.store.js";
import { computed } from "vue";
const cartStore = useCartStore();
const deferred = computed(() => cartStore.deferredOrder);
</script>

<template>
    <section class="deferred-view container">
        <h1>Отложенное</h1>
        <div v-if="deferred.length === 0">У вас нет закладок...</div>
        <div v-else class="product-grid">
            <CardProduct
                v-for="product in deferred"
                :key="product.id"
                :product="product"
                route="deferred"
            />
        </div>
    </section>
</template>
