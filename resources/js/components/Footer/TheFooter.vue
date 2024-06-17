<script setup>
import TheLogo from "@/components/TheLogo.vue";
</script>

<template>
    <footer class="footer">
        <div class="footer__inner container">
            <nav class="footer__navigation navigation">
                <TheLogo />
                <ul class="footer__menu menu">
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
                </ul>
            </nav>
            <div class="footer__copyright">Copyright ©fanadape 2024</div>
        </div>
    </footer>
</template>

<style lang="scss" scoped>
@import "/resources/css/variables.scss";

.footer {
    margin-top: 100px;

    &__navigation {
        @media #{$mq-md} {
            flex-direction: column;
            gap: 30px;
        }
    }

    &__menu {
        @media #{$mq-sm} {
            flex-direction: column;
        }
    }

    &__copyright {
        border-top: 1px solid $color-gray;
        margin-top: 35px;
        padding: 25px 0;
        font-size: 14px;
        color: $color-gray;
        display: flex;
        justify-content: end;
    }
}
</style>
