<script setup>
import CardProduct from "@/components/Card/CardProduct.vue";
</script>

<template>
    <section class="cart container">
        <h1>Корзина</h1>
        <div class="product-grid">
            <CardProduct v-for="product in 8" :key="product.id" />
        </div>
    </section>
</template>

<style lang="scss" scoped>
@import "/resources/css/variables.scss";
</style>
