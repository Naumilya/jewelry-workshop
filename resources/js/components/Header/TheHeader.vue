<script setup>
import TheLogo from "@/components/TheLogo.vue";
import { useUserStore } from "@/stores/user.store.js";
import { Icon } from "@iconify/vue";
import { ref } from "vue";

const userStore = useUserStore();
const isMenuOpen = ref(false);
const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};
const closeMenu = () => {
    isMenuOpen.value = false;
};
</script>

<template>
    <header class="header">
        <nav class="header__navigation navigation container">
            <TheLogo />
            <div class="burger" @click="toggleMenu">
                <span
                    :class="{
                        burger__line: true,
                        burger__line_open: isMenuOpen,
                    }"
                ></span>
                <span
                    :class="{
                        burger__line: true,
                        burger__line_open: isMenuOpen,
                    }"
                ></span>
                <span
                    :class="{
                        burger__line: true,
                        burger__line_open: isMenuOpen,
                    }"
                ></span>
            </div>
            <ul
                :class="{
                    header__menu: true,
                    menu: true,
                    menu_open: isMenuOpen,
                }"
            >
                <li @click="closeMenu">
                    <router-link to="/news" class="menu__link"
                        >Новости</router-link
                    >
                </li>
                <li @click="closeMenu">
                    <router-link to="/catalog" class="menu__link"
                        >Каталог</router-link
                    >
                </li>
                <li @click="closeMenu">
                    <router-link to="/custom-jewelry" class="menu__link"
                        >Украшения на заказ</router-link
                    >
                </li>
                <li @click="closeMenu">
                    <router-link to="/contacts" class="menu__link"
                        >Контакты</router-link
                    >
                </li>
                <li @click="closeMenu">
                    <router-link
                        to="/deferred"
                        class="menu__link menu__link_icon"
                    >
                        <Icon icon="ion:heart-circle" />
                    </router-link>
                </li>
                <li @click="closeMenu">
                    <router-link to="/cart" class="menu__link menu__link_icon">
                        <Icon icon="ion:basket" />
                    </router-link>
                </li>
                <li @click="closeMenu">
                    <router-link
                        :to="userStore.token ? '/profile' : '/registration'"
                        class="menu__link menu__link_icon"
                    >
                        <Icon
                            :icon="
                                userStore.token
                                    ? 'ion:person-circle'
                                    : 'ion:enter-outline'
                            "
                        />
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

.burger {
    display: none;
    flex-direction: column;
    justify-content: space-between;
    width: 30px;
    height: 21px;
    cursor: pointer;

    @media #{$mq-md} {
        display: flex;
    }

    &__line {
        background: $color-white;
        height: 3px;
        border-radius: 2px;
        transition: $transition;

        &.burger__line_open:nth-child(1) {
            transform: translateY(9px) rotate(45deg);
        }

        &.burger__line_open:nth-child(2) {
            opacity: 0;
        }

        &.burger__line_open:nth-child(3) {
            transform: translateY(-9px) rotate(-45deg);
        }
    }
}

.header__menu {
    display: flex;
    align-items: center;
    gap: 38px;
    list-style: none;

    @media #{$mq-md} {
        flex-direction: column;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: $color-black;
        padding: 20px;
        opacity: 0;
        visibility: hidden;
        max-height: 0;
        overflow: hidden;
        transition: $transition;
    }

    &.menu_open {
        opacity: 1;
        visibility: visible;
        max-height: 600px; /* Adjust the height as necessary */
    }

    .menu__link {
        color: $color-white;
        text-decoration: none;

        &_icon {
            font-size: 25px;
        }

        &:hover {
            color: $color-gold;
            transition: $transition-fast;
        }

        @media #{$mq-md} {
            padding: 10px 0;
            width: 100%;
        }
    }

    .menu__close {
        display: none;

        @media #{$mq-md} {
            display: block;
            width: 100%;
            text-align: right;
            margin-bottom: 20px;

            button {
                background: none;
                border: none;
                color: $color-white;
                font-size: 16px;
                cursor: pointer;
            }
        }
    }
}
</style>
