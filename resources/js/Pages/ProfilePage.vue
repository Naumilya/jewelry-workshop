<script setup>
import { useUserStore } from "@/stores/user.store.js";
import { computed, onMounted } from "vue";
import { useRouter } from "vue-router";

const userStore = useUserStore();
const router = useRouter();

const logout = () => {
    userStore.logout();
    router.push("/login");
};

onMounted(async () => {
    if (!userStore.token) {
        router.push("/login");
    } else {
        await userStore.fetchOrdersByUserId(userStore.id);
    }
});

const orders = computed(() => userStore.orders || []);
</script>

<template>
    <section class="user-info container">
        <h1>Профиль</h1>
        <div class="user-info__about">
            <div class="user-info__name">
                <h2>{{ userStore.name }}</h2>
                <p class="user-info__date">
                    Дата регистрации:
                    {{ userStore.getFormattedDate() }}
                </p>
            </div>
            <div class="user-info__email">
                <h2>Почта:</h2>
                {{ userStore.email }}
            </div>
        </div>
    </section>
    <section class="orders container">
        <h2>Мои заказы</h2>
        <div class="orders__empty" v-if="orders.length === 0">
            <span>Здесь пока что ничего нет...</span>
            <router-link to="/catalog">Перейти в Каталог</router-link>
        </div>
        <div class="orders__list" v-else>
            <div v-for="order in orders" :key="order.id" class="order">
                <div class="order-row">
                    <div class="order-detail">
                        <img
                            :src="order.product.image_path"
                            alt="Product Image"
                            class="product-image"
                        />
                    </div>
                    <div class="order-detail">
                        <p class="order-text">
                            <strong>Название:</strong> {{ order.product.name }}
                        </p>
                    </div>
                    <div class="order-detail">
                        <p class="order-text">
                            <strong>Цена:</strong> {{ order.total_cost }} руб.
                        </p>
                    </div>
                    <div class="order-detail">
                        <p class="order-text">
                            <strong>ID:</strong> {{ order.id }}
                        </p>
                    </div>
                    <div class="order-detail">
                        <p class="order-text">
                            <strong>Статус:</strong> {{ order.status }}
                        </p>
                    </div>
                </div>
                <hr class="order-divider" />
            </div>
        </div>
    </section>
    <section class="logout container">
        <form @submit.prevent="logout" class="logout">
            <button type="submit" class="button button_transparent">
                Выйти из аккаунта
            </button>
        </form>
    </section>
</template>

<style lang="scss" scoped>
@import "/resources/css/variables.scss";

.user-info {
    &__about {
        margin-top: 32px;
        display: flex;
        align-items: center;
        gap: 130px;

        @media #{$mq-sm} {
            flex-direction: column;
            gap: 20px;
            align-items: flex-start;
        }
    }

    &__email {
        font-size: 24px;
        font-weight: 300;
        font-family: Raleway, sans-serif;
        display: flex;
        flex-direction: column;
        gap: 10px;

        @media #{$mq-sm} {
            font-size: 18px;
        }
    }

    &__date {
        color: $color-gray;
    }
}

.orders {
    margin-top: 40px;

    &__empty {
        margin-top: 40px;
        font-size: 24px;
        font-weight: 300;
        display: flex;
        gap: 15px;
        justify-content: center;
        align-items: center;
        flex-direction: column;

        @media #{$mq-sm} {
            font-size: 18px;
        }
    }

    &__list {
        margin-top: 20px;
    }

    .order {
        margin-bottom: 10px;
    }

    .order-row {
        display: flex;
        align-items: center;
        padding: 15px;
        overflow: hidden;
        width: max-content;
        justify-content: space-between;
        width: 100%;

        @media #{$mq-sm} {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    .order-detail {
        flex: 1;
        text-align: center;

        @media #{$mq-sm} {
            text-align: left;
            width: 100%;
        }

        img.product-image {
            width: 100px;
            height: auto;
            border-radius: 8px;

            @media #{$mq-sm} {
                width: 80px;
            }
        }

        .order-text {
            margin: 5px 0;
            font-size: 16px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;

            @media #{$mq-sm} {
                font-size: 14px;
                white-space: normal;
            }
        }

        &:not(:last-child, :first-child, :nth-child(2)) {
            border-right: 1px solid $color-gray;

            @media #{$mq-sm} {
                border-right: none;
                border-bottom: 1px solid $color-gray;
            }
        }
    }

    .order-divider {
        width: 100%;
        margin: 10px 0;
        border: none;
    }
}

.logout {
    margin-top: 40px;
    display: flex;
    justify-content: end;

    @media #{$mq-sm} {
        justify-content: center;
    }
}
</style>
