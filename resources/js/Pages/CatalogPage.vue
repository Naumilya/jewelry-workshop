<template>
    <section class="catalog container">
        <h1>Каталог</h1>
        <div class="catalog__grid">
            <router-link to="/catalog/category" class="catalog__item div1">
                <div class="catalog__item-inner">
                    <h2 class="catalog__category-title">Кольца</h2>
                    <img
                        class="catalog__category-image"
                        src="/images/categories/rings.jpg"
                        alt="categories"
                    />
                </div>
            </router-link>
            <router-link to="/catalog/category" class="catalog__item div2">
                <div class="catalog__item-inner">
                    <h2 class="catalog__category-title">Серьги</h2>
                    <img
                        class="catalog__category-image"
                        src="/images/categories/earrings.jpg"
                        alt="categories"
                    />
                </div>
            </router-link>
            <router-link
                to="/catalog/category"
                class="catalog__item catalog__item_small div3"
            >
                <div class="catalog__item-inner">
                    <h2 class="catalog__category-title">Цепи</h2>
                    <img
                        class="catalog__category-image"
                        src="/images/categories/chains.png
                        "
                        alt="categories"
                    />
                </div>
            </router-link>
            <router-link
                to="/catalog/category"
                class="catalog__item catalog__item_small div4"
            >
                <div class="catalog__item-inner">
                    <h2 class="catalog__category-title">Брошки</h2>
                    <img
                        class="catalog__category-image"
                        src="/images/categories/brooches.png
                        "
                        alt="categories"
                    />
                </div>
            </router-link>
            <router-link
                to="/catalog/category"
                class="catalog__item catalog__item_small div5"
            >
                <div class="catalog__item-inner">
                    <h2 class="catalog__category-title">Подвески</h2>
                    <img
                        class="catalog__category-image"
                        src="/images/categories/pendants.png"
                        alt="categories"
                    />
                </div>
            </router-link>
            <router-link
                to="/catalog/category"
                class="catalog__item catalog__item_small div6"
            >
                <div class="catalog__item-inner">
                    <h2 class="catalog__category-title">Браслеты</h2>
                    <img
                        class="catalog__category-image"
                        src="/images/categories/bracelets.png"
                        alt="categories"
                    />
                </div>
            </router-link>
            <router-link to="/catalog/category" class="catalog__item div7">
                <div class="catalog__item-inner">
                    <h2 class="catalog__category-title">Колье</h2>
                    <img
                        class="catalog__category-image"
                        src="/images/categories/necklaces.jpg"
                        alt="categories"
                    />
                </div>
            </router-link>
            <router-link
                to="/catalog/category"
                class="catalog__item catalog__item_small div8"
            >
                <div class="catalog__item-inner">
                    <h2 class="catalog__category-title">Религия</h2>
                    <img
                        class="catalog__category-image"
                        src="/images/categories/religions.png"
                        alt="categories"
                    />
                </div>
            </router-link>
            <router-link
                to="/catalog/category"
                class="catalog__item catalog__item_small div9"
            >
                <div class="catalog__item-inner">
                    <h2 class="catalog__category-title">Сувениры</h2>
                    <img
                        class="catalog__category-image"
                        src="/images/categories/souvenirs.png"
                        alt="categories"
                    />
                </div>
            </router-link>
            <router-link to="/catalog/category" class="catalog__item div10">
                <div class="catalog__item-inner">
                    <h2 class="catalog__category-title">Часы</h2>
                    <img
                        class="catalog__category-image"
                        src="/images/categories/clocks.png"
                        alt="categories"
                    />
                </div>
            </router-link>
        </div>
    </section>
</template>

<script setup></script>

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
}
</style>
