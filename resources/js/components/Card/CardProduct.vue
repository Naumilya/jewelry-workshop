<script setup>
import { useCartStore } from "@/stores/cart.store.js";
import { Icon } from "@iconify/vue/dist/iconify.js";

defineProps({
    product: {
        id: Number,
        name: String,
        image_path: String,
        detail: String,
        cost: String,
    },
    route: String,
});

const cartStore = useCartStore();

const inCart = (product) => cartStore.isInCart(product);
const inDeferredOrder = (product) => cartStore.isInDeferredOrder(product);

const toggleCart = (product) => {
    cartStore.toggleCart(product);
};

const toggleDeferredOrder = (product) => {
    cartStore.toggleDeferredOrder(product);
};
</script>

<template>
    <div class="card-product">
        <router-link class="card" :to="`/catalog/${route}/${product.id}`">
            <img class="card-product__image" :src="product.image_path" />
            <div class="card-product__row">
                <h4 class="card-product__title">{{ product.name }}</h4>
            </div>
        </router-link>
        <div class="card-product__row">
            <span class="card-product__price">{{ product.cost }} р.</span>
            <div class="card-product__buttons">
                <Icon
                    :class="{ 'icon-active': inDeferredOrder(product) }"
                    icon="ion:heart-circle"
                    @click="toggleDeferredOrder(product)"
                />
                <Icon
                    :class="{ 'icon-active': inCart(product) }"
                    icon="ion:basket"
                    @click="toggleCart(product)"
                />
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
@import "/resources/css/variables.scss";

.icon-active {
    color: $color-gold;
}

.card {
    text-decoration: none;
    color: $color-white;
}

.card-product {
    max-width: 270px;
    &__image {
        width: 100%;
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
