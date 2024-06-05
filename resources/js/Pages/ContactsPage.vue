<script setup>
import { Icon } from "@iconify/vue/dist/iconify.js";
</script>

<template>
    <section class="contacts container">
        <h1>Контакты</h1>
        <div class="contact-list">
            <div class="contact-list__item">
                <h2>Номер телефона:</h2>
                <a href="tel:89680077951">+79680077951</a>
            </div>
            <div class="contact-list__item">
                <h2>Почта</h2>
                <a
                    href="mailto:goldenhands@gmail.com?cc=&subject=%D0%97%D0%B4%D1%80%D0%B0%D0%B2%D1%81%D1%82%D0%B2%D1%83%D0%B9%2C%20%D0%B4%D0%BE%D1%80%D0%BE%D0%B3%D0%BE%D0%B9%20%D0%B4%D1%80%D1%83%D0%B3%21&body=%D0%94%D0%B0%D0%B2%D0%BD%D0%BE%20%D0%BD%D0%B5%20%D1%81%D0%BF%D0%B8%D1%81%D1%8B%D0%B2%D0%B0%D0%BB%D0%B8%D1%81%D1%8C.%0A%0A%D0%9A%D0%B0%D0%BA%20%D0%B4%D0%B5%D0%BB%D0%B0%3F"
                    >goldenhands@gmail.com</a
                >
            </div>
            <div class="contact-list__item">
                <h2>Соц. сети</h2>
                <div class="socials">
                    <a href="https://vk.com/fanadape">
                        <Icon icon="ion:logo-vk" />
                    </a>
                    <a
                        href="https://www.youtube.com/channel/UCaJRfXcWV-i1acfSymQjPpQ"
                    >
                        <Icon icon="ion:logo-youtube" />
                    </a>
                    <a href="https://ru.pinterest.com/fanadape/">
                        <Icon icon="ion:logo-pinterest" />
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="map container">
        <div class="map__content">
            <h2>Где мы находимся?</h2>
            <img src="/images/icon.svg" alt="icon" />
        </div>
        <iframe
            src="https://yandex.ru/map-widget/v1/?um=constructor%3Ad675be55588c705554bc5733efcb1e9d9144af5362c59dc669ca36e709b86a7a&amp;source=constructor"
            class="map__map"
            width="100%"
            height="max-content"
            frameborder="0"
        ></iframe>
    </section>
</template>

<style lang="scss" scoped>
@import "/resources/css/variables.scss";

.contact-list {
    margin-top: 45px;
    display: flex;
    gap: 75px;

    &__item {
        display: flex;
        flex-direction: column;
    }

    .socials {
        display: flex;
        gap: 30px;

        *:hover {
            color: $color-gold;
        }
    }

    h2 {
        font-family: Raleway;
        font-weight: 400;
    }

    a {
        font-family: Raleway;
        margin-top: 10px;
        font-size: 24px;
        color: $color-white;
        text-decoration: none;
    }
}

.map {
    margin-top: 85px;
    display: flex;
    gap: 90px;

    &__map {
        border-radius: $border-radius-small;
    }

    &__content {
        img {
            margin-top: 45px;
            max-height: 238px;
        }
    }
}
</style>
