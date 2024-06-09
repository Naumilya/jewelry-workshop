<script setup>
import { Icon } from "@iconify/vue/dist/iconify.js";
import { defineProps } from "vue";
defineProps({
    product: {
        name: String,
        detail: String,
    },
});
</script>

<template>
    <div class="card-product">
        <img class="card-product__image" src="/images/products/ring1.png" />
        <div class="card-product__row">
            <h4 class="card-product__title">{{ product.name }}</h4>
        </div>
        <div class="card-product__row">
            <span class="card-product__price">12 700 р.</span>
            <div class="card-product__buttons">
                <Icon icon="ion:heart-circle" />
                <Icon icon="ion:basket" />
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
@import "/resources/css/variables.scss";

.card-product {
    max-width: 270px;
    &__image {
        background-color: $color-gray;
        padding: 7px 0;
        border-radius: $border-radius-small;
    }

    &__row {
        display: flex;
        justify-content: space-between;
    }

    &__buttons {
        display: flex;
        align-items: center;
        font-size: 24px;
        gap: 20px;
    }
    &__title {
        margin-top: 12px;
        font-weight: 300;
        font-size: 16px;
    }
    &__price {
        font-family: Raleway;
        font-size: 24px;
        font-weight: 600;
        margin-top: 10px;
    }
}
</style>
