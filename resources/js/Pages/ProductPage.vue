<script setup>
import { useCartStore } from "@/stores/cart.store.js";
import { Icon } from "@iconify/vue/dist/iconify.js";
import axios from "axios";
import { computed, onMounted, ref } from "vue";
import { useRoute } from "vue-router";

const product = ref(null);
const route = useRoute();
const cartStore = useCartStore();

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

function toggleCart() {
    cartStore.toggleCart(product.value);
}

function toggleDeferredOrder() {
    cartStore.toggleDeferredOrder(product.value);
}

const isInCart = computed(() => cartStore.isInCart(product.value));
const isInDeferredOrder = computed(() =>
    cartStore.isInDeferredOrder(product.value)
);
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
                        <Icon
                            icon="ion:heart-circle"
                            @click="toggleDeferredOrder"
                            :class="{ active: isInDeferredOrder }"
                        />
                        <Icon
                            icon="ion:basket"
                            @click="toggleCart"
                            :class="{ active: isInCart }"
                        />
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

.active {
    color: $color-gold;
}

.product {
    display: flex;
    align-items: center;
    gap: 30px;

    @media #{$mq-sm} {
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
    }

    &__title {
        font-size: 40px;

        @media #{$mq-sm} {
            font-size: 30px;
        }
    }

    &__detail {
        margin-top: 20px;

        @media #{$mq-sm} {
            margin-top: 10px;
        }
    }

    &__cost {
        &-title {
            font-weight: 300;
            font-family: Raleway;
        }
    }

    &__text {
        max-width: 570px;

        @media #{$mq-sm} {
            max-width: 100%;
        }
    }

    &__image {
        width: 100%;
        background: $color-gray;
        border-radius: $border-radius-small;

        @media #{$mq-sm} {
            width: 100%;
        }
    }

    &__row {
        display: flex;
        margin-top: 40px;
        justify-content: space-between;
        align-items: center;

        @media #{$mq-sm} {
            flex-direction: column;
            align-items: flex-start;
            gap: 20px;
            margin-top: 20px;
        }
    }

    &__icon {
        font-size: 50px;
        display: flex;
        gap: 20px;

        @media #{$mq-sm} {
            font-size: 40px;
            gap: 15px;
        }

        *:hover {
            cursor: pointer;
            color: $color-gold;
        }
    }
}
</style>
