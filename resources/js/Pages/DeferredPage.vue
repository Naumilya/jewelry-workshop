<script setup>
import CardProduct from "@/components/Card/CardProduct.vue";
</script>

<template>
    <section class="deferred container">
        <h1>Отложенное</h1>
        <div class="product-grid">
            <CardProduct v-for="product in 8" :key="product.id" />
        </div>
    </section>
</template>

<style lang="scss" scoped></style>
