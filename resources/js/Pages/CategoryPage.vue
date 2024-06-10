<script setup>
import CardProduct from "@/components/Card/CardProduct.vue";
import axios from "axios";
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();
const products = ref([]);
const categoryTitle = ref("");
const categoryRoute = ref("");

onMounted(async () => {
    try {
        const response = await axios.get(`/api/catalog/${route.params.name}`);
        products.value = response.data.products;
        categoryTitle.value = response.data.category_title;
        categoryRoute.value = response.data.category_route;
        console.log(products.value);
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
                :route="categoryRoute"
                v-for="product in products"
                :key="product.id"
                :product="product"
            />
        </div>
    </section>
</template>

<style lang="scss" scoped></style>
