<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import CardProduct from "@/components/Card/CardProduct.vue";
import { useRoute } from "vue-router";

const route = useRoute();
const products = ref([]);
const categoryTitle = ref("");

onMounted(async () => {
    try {
        const response = await axios.get(`/api/catalog/${route.params.name}`);
        products.value = response.data.products;
        categoryTitle.value = response.data.category_title;
    } catch (error) {
        console.error(error);
    }
});
</script>

<template>
    <section class="container">
        <h1>{{ categoryTitle }}</h1>
        <div class="product-grid">
            <CardProduct
                v-for="product in products"
                :key="product.id"
                :product="product"
            />
        </div>
    </section>
</template>

<style lang="scss" scoped></style>
