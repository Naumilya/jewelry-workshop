<script setup>
import TheLogo from "@/components/TheLogo.vue";
import { Icon } from "@iconify/vue";
</script>

<template>
    <header class="header">
        <nav class="header__navigation navigation container">
            <TheLogo />
            <ul class="header__menu menu">
                <li>
                    <router-link to="/news" class="menu__link">
                        Новости
                    </router-link>
                </li>
                <li>
                    <router-link to="/catalog" class="menu__link"
                        >Каталог
                    </router-link>
                </li>
                <li>
                    <router-link to="/custom-jewelry" class="menu__link">
                        Украшения на заказ
                    </router-link>
                </li>
                <li>
                    <router-link to="/contacts" class="menu__link">
                        Контакты
                    </router-link>
                </li>
                <li>
                    <router-link
                        to="/deferred"
                        class="menu__link menu__link_icon"
                    >
                        <Icon icon="ion:heart-circle" />
                    </router-link>
                </li>
                <li>
                    <router-link to="/cart" class="menu__link menu__link_icon">
                        <Icon icon="ion:basket" />
                    </router-link>
                </li>
                <li v-if="false">
                    <router-link
                        to="/profile"
                        class="menu__link menu__link_icon"
                    >
                        <Icon icon="ion:person-circle" />
                    </router-link>
                </li>
                <li v-else>
                    <router-link
                        to="/registration"
                        class="menu__link menu__link_icon"
                    >
                        <Icon icon="ion:enter-outline" />
                    </router-link>
                </li>
            </ul>
        </nav>
    </header>
</template>

<style lang="scss" scoped>
@import "/resources/css/variables.scss";

.header {
    z-index: 5;
    padding: 25px 0;
    background: $color-black;
    position: sticky;
    top: 0;
}
</style>
