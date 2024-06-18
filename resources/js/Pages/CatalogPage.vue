<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";

const categories = ref([]);

onMounted(async () => {
    const response = await axios.get("/api/categories");
    categories.value = response.data;
});

const getItemClass = (index) => {
    const smallIndexes = [2, 3, 4, 5, 7, 8];
    return smallIndexes.includes(index) ? "catalog__item_small" : "";
};

const getGridClass = (index) => {
    const gridClasses = {
        0: "div1",
        1: "div2",
        2: "div3",
        3: "div4",
        4: "div5",
        5: "div6",
        6: "div7",
        7: "div8",
        8: "div9",
        9: "div10",
    };
    return gridClasses[index];
};
</script>

<template>
    <section class="catalog container">
        <h1>Каталог</h1>
        <div class="catalog__grid">
            <router-link
                v-for="(category, index) in categories"
                :key="category.id"
                :to="`/catalog/${category.name}`"
                :class="[
                    'catalog__item',
                    getItemClass(index),
                    getGridClass(index),
                ]"
            >
                <div class="catalog__item-inner">
                    <h2 class="catalog__category-title">
                        {{ category.name_ru }}
                    </h2>
                    <img
                        class="catalog__category-image"
                        :src="`/images/categories/${category.name}.png`"
                        alt="categories"
                    />
                </div>
            </router-link>
        </div>
    </section>
</template>

<style lang="scss" scoped>
@import "/resources/css/variables.scss";

.catalog {
    &__grid {
        margin-top: 40px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-template-rows: repeat(4, 1fr);
        grid-column-gap: 30px;
        grid-row-gap: 30px;

        @media #{$mq-sm} {
            display: flex;
            flex-direction: column;
            row-gap: 20px;
        }
    }

    &__item {
        text-decoration: none;
        overflow: hidden;

        &_small {
            padding-bottom: 45px;
            .catalog__item-inner {
                height: 270px;
                h2 {
                    position: absolute;
                    bottom: -45px;
                    left: 50%;
                    transform: translateX(-50%);
                    font-size: 24px;
                    font-weight: 500;
                    color: $color-white;
                    padding: 0;
                }

                .catalog__category-image {
                    border-radius: 12px;
                    max-width: 100%;
                    object-fit: cover;
                    padding: 15px 0;
                }
            }
        }
    }

    &__item-inner {
        display: flex;
        justify-content: space-between;
        gap: 25px;
        background-color: $color-gray;
        height: 100%;
        border-radius: $border-radius-small;

        position: relative;
    }

    &__category-title {
        color: $color-black;
        padding: 20px 0 0 30px;
    }

    &__category-image {
        border-radius: 0 12px 12px 0;
        max-width: 70%;
        object-fit: cover;
        width: 100%;
    }

    .div1 {
        grid-area: 1 / 1 / 2 / 3;
    }
    .div2 {
        grid-area: 1 / 3 / 2 / 5;
    }
    .div3 {
        grid-area: 2 / 1 / 3 / 2;
    }
    .div4 {
        grid-area: 2 / 2 / 3 / 3;
    }
    .div5 {
        grid-area: 2 / 3 / 3 / 4;
    }
    .div6 {
        grid-area: 2 / 4 / 3 / 5;
    }
    .div7 {
        grid-area: 3 / 1 / 4 / 3;
    }
    .div8 {
        grid-area: 4 / 1 / 5 / 2;
    }
    .div9 {
        grid-area: 4 / 2 / 5 / 3;
    }
    .div10 {
        grid-area: 3 / 3 / 5 / 5;
    }

    @media #{$mq-sm} {
        .div1,
        .div2,
        .div3,
        .div4,
        .div5,
        .div6,
        .div7,
        .div8,
        .div9,
        .div10 {
            grid-area: unset;
        }
    }
}
</style>
