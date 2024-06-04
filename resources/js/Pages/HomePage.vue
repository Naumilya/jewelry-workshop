<script setup>
import NewsGrid from "@/components/News/NewsGrid.vue";
import "swiper/css";
import { Swiper, SwiperSlide } from "swiper/vue";

import "swiper/css/pagination";
import { Autoplay, Pagination } from "swiper/modules";

const modules = [Pagination, Autoplay];
</script>

<template>
    <section class="hero container">
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
    <section class="about container">
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
    <section class="news container">
        <h2>Последнии новости</h2>
        <NewsGrid :countOfNews="4" />
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

    &__list {
        margin-top: 37px;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        column-gap: 30px;
        row-gap: 60px;
    }

    &__item {
        max-width: 570px;
    }

    &__image {
        border-radius: $border-radius;
        width: 100%;
    }

    &__header {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    &__created {
        font-weight: 300;
    }

    &__image {
        margin-top: 14px;
    }

    &__copyright {
        margin-top: 20px;
        font-family: Raleway, sans-serif;
    }

    &__theme {
        font-size: 24px;
        font-weight: normal;
        max-width: max-content;
        color: $color-black;
        border-radius: $border-radius-small;
        padding: 4px 25px;
        background: $color-gold;
    }

    &__description {
        margin-top: 20px;
        font-family: Raleway;
    }

    &__button {
        font-family: Raleway;
        margin-top: 20px;
        display: inline-block;
        color: $color-gold;
        text-decoration: none;
        font-weight: 300;
        font-size: 14px;
    }
}
</style>
