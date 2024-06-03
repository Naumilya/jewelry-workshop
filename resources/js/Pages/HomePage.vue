<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";

import "swiper/css";

import "swiper/css/pagination";
import { Autoplay, Pagination } from "swiper/modules";

const modules = [Pagination, Autoplay];
</script>

<template>
    <section class="hero">
        <swiper
            :pagination="{
                clickable: true,
            }"
            :style="[
                '--swiper-pagination-color: #ffe766',
                '--swiper-pagination-bullet-inactive-color: #cfcece',
                '--swiper-pagination-bullet-size: 10px',
                '--swiper-pagination-bullet-horizontal-gap: 6px',
                '--swiper-pagination-bottom: 0px;',
            ]"
            :autoplay="{
                delay: 2500,
                disableOnInteraction: false,
            }"
            :modules="modules"
            class="mySwiper"
        >
            <swiper-slide class="hero__slide">
                <img
                    src="/images/slides/photo-slider.jpg"
                    alt="photo-slider"
                    class="hero__photo"
                />
                <div class="hero__text">
                    <h1 class="hero__title">Золотые руки озолотят ваши руки</h1>
                    <p class="hero__description">
                        Наша компания занимается: ремонтом, изготовлением
                        ювелирной продукции, которую вы можете заказать у нас на
                        сайте, но если не найдете что-то чтобы вас зацепило, то
                        можете заказать украшение на заказ
                    </p>
                    <router-link to="/catalog" class="hero__button">
                        Каталог
                    </router-link>
                </div>
            </swiper-slide>
            <swiper-slide class="hero__slide">
                <div class="hero__text">
                    <h1 class="hero__title">Золотые руки озолотят ваши руки</h1>
                    <p class="hero__description">
                        Наша компания занимается: ремонтом, изготовлением
                        ювелирной продукции, которую вы можете заказать у нас на
                        сайте, но если не найдете что-то чтобы вас зацепило, то
                        можете заказать украшение на заказ
                    </p>
                    <router-link to="/catalog" class="hero__button">
                        Каталог
                    </router-link>
                </div>
                <img
                    src="/images/slides/photo-slider2.jpg"
                    alt="photo-slider"
                    class="hero__photo"
                />
            </swiper-slide>
            <swiper-slide class="hero__slide">
                <img
                    src="/images/slides/photo-slider3.jpg"
                    alt="photo-slider"
                    class="hero__photo"
                />
                <div class="hero__text">
                    <h1 class="hero__title">Золотые руки озолотят ваши руки</h1>
                    <p class="hero__description">
                        Наша компания занимается: ремонтом, изготовлением
                        ювелирной продукции, которую вы можете заказать у нас на
                        сайте, но если не найдете что-то чтобы вас зацепило, то
                        можете заказать украшение на заказ
                    </p>
                    <router-link to="/catalog" class="hero__button">
                        Каталог
                    </router-link>
                </div>
            </swiper-slide>
        </swiper>
    </section>
    <section class="about">
        <img src="/images/icon.svg" alt="icon" />
        <div class="about__text">
            <h2>Немного о нас</h2>
            <p class="about__paragraph">
                В деревне Чуваки, расположенной в Пермском крае, история
                создания ювелирной мастерской "Золотые руки" началась с глубокой
                традиции и уважения к искусству ювелирного дела. В 1671 году
                деревня была основана, и с тех пор местные мастера продолжали
                развивать свои навыки и унаследовать традиции от предков.
            </p>
            <p class="about__paragraph">
                Мастерская была создана в 2018 году, когда мода на уникальные
                украшения стала особенно популярной. Она предлагает изготовление
                украшений на заказ, ювелирных каталогов, а также эксклюзивных
                украшений по эскизам и желаниям клиентов. Мастерская также
                предлагает услуги по ремонту ювелирных изделий любой сложности,
                алмазной фотогравировке и гравировке.
            </p>
            <p class="about__paragraph">
                Таким образом, история создания ювелирной мастерской "Золотые
                руки" в деревне Чуваки началась с глубокой традиции и уважения к
                искусству ювелирного дела. Мастерская продолжает развивать
                традиции и создавать уникальные украшения для местных жителей и
                для праздников, которые проводятся в деревне
            </p>
        </div>
    </section>
    <section class="news">
        <h2>Последнии новости</h2>
        <router-link to="/"></router-link>
    </section>
</template>

<style scoped lang="scss">
@import "/resources/css/variables.scss";

.mySwiper {
    min-height: 381px;
    width: 100%;
    height: 100%;
}

.hero {
    &__photo {
        border-radius: $border-radius;
    }
    &__description {
        margin-top: 18px;
    }
    &__button {
        margin-top: 36px;
    }

    &__slide {
        display: flex;
        gap: 30px;
    }

    &__button {
        display: inline-block;
        padding: 13px 22px;
        background-color: $color-gold;
        border-radius: $border-radius-small;
        text-decoration: none;
        color: $color-black;
        font-weight: 800;
        font-family: Roboto, sans-serif;
        font-size: 16px;
    }
}

.about {
    display: flex;
    gap: 124px;
    margin-top: 80px;

    &__paragraph {
        margin-top: 17px;
    }
}

.news {
    margin-top: 110px;
}
</style>
