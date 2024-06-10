<script setup>
import { Icon } from "@iconify/vue/dist/iconify.js";
import axios from "axios";
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";
const product = ref(null);
const route = useRoute();

onMounted(async () => {
    const productId = parseInt(route.params.id);
    try {
        const response = await axios.get(
            `http://127.0.0.1:8000/api/product/${productId}`
        );
        product.value = response.data.data;
        console.log(product.value);
    } catch (error) {
        console.error(error);
    }
});
</script>

<template>
    <section class="container">
        <div class="product" v-if="product">
            <div class="product__text">
                <h1 class="product__title">{{ product.name }}</h1>
                <p class="product__detail">{{ product.detail }}</p>

                <div class="product__row">
                    <div class="product__cost">
                        <h2 class="product__cost-title">Цена:</h2>
                        <h2>{{ product.cost }} р.</h2>
                    </div>
                    <div class="product__icon">
                        <Icon icon="ion:heart-circle" />
                        <Icon icon="ion:basket" />
                    </div>
                </div>
            </div>
            <img
                class="product__image"
                :src="product.image_path"
                :alt="product.alt"
            />
        </div>
        <div v-else>Loading...</div>
    </section>
</template>

<style lang="scss" scoped>
@import "/resources/css/variables.scss";

.product {
    display: flex;
    align-items: center;
    gap: 30px;

    &__title {
        font-size: 40px;
    }

    &__detail {
        margin-top: 20px;
    }

    &__cost {
        &-title {
            font-weight: 300;
            font-family: Raleway;
        }
    }

    &__text {
        max-width: 570px;
    }

    &__image {
        width: 100%;
        background: $color-gray;
        border-radius: $border-radius-small;
    }

    &__row {
        display: flex;
        margin-top: 40px;
        justify-content: space-between;
        align-items: center;
    }

    &__icon {
        font-size: 50px;
        display: flex;
        gap: 20px;
        *:hover {
            cursor: pointer;
            color: $color-gold;
        }
    }
}
</style>
