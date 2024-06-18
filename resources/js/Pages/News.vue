<script setup>
import axios from "axios";
import { ref } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();
const newsItem = ref(null); // Initialize with null to avoid undefined access

axios
    .get(`http://127.0.0.1:8000/api/v1/news/${route.params.id}/`)
    .then((response) => {
        newsItem.value = response.data;
    })
    .catch((error) => {
        console.error(error);
    });

function dateFormat(date) {
    const dateObj = new Date(date);
    const day = dateObj.getDate();
    const month = dateObj.getMonth() + 1;
    const year = dateObj.getFullYear();
    return `${day < 10 ? "0" : ""}${day}.${
        month < 10 ? "0" : ""
    }${month}.${year}`;
}
</script>

<template>
    <section v-if="newsItem" class="news container">
        <!-- Conditional rendering -->
        <h1 class="news__title">{{ newsItem.title }}</h1>

        <div class="news__header">
            <h4 class="news__theme">{{ newsItem.theme }}</h4>
            <div class="new__created">
                {{ dateFormat(newsItem.created_at) }}
            </div>
        </div>
        <div class="news__content">
            <img :src="newsItem.image_path" alt="news" class="news__image" />
            <p class="news__copyright">
                {{ newsItem.copyright }}
            </p>
            <p class="news__description">
                {{ newsItem.description }}
            </p>
            <router-link class="news__button" to="/"> На главную </router-link>
        </div>
    </section>
    <div v-else>
        Loading...
        <!-- Optionally, show a loading indicator -->
    </div>
</template>

<style lang="scss" scoped>
@import "/resources/css/variables.scss";

.news {
    &__title {
        @media #{$mq-md} {
            font-size: 24px;
        }
    }
    &__header {
        margin-top: 15px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    &__theme {
        padding: 4px 25px;
        background: $color-gold;
        color: $color-black;
        border-radius: $border-radius-small;
        font-size: 24px;
        font-family: Raleway, sans-serif;
        font-weight: 300;
    }

    &__content {
        margin-top: 15px;
    }

    &__image {
        width: 100%;
        border-radius: $border-radius;
        max-height: 470px;
        object-fit: cover;
    }

    &__copyright {
        font-size: 16px;
        font-family: Raleway, sans-serif;
        font-weight: 300;
        margin-top: 35px;
    }

    &__description {
        margin-top: 25px;
        font-size: 16px;
        font-family: Roboto, sans-serif;
        font-weight: 300;
    }

    &__button {
        font-size: 20px;
        font-family: Raleway;
        margin-top: 20px;
        display: inline-block;
        color: $color-gold;
        text-decoration: none;
        font-weight: 300;
    }
}
</style>

<style lang="scss" scoped>
@import "/resources/css/variables.scss";
.news {
    &__header {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    &__theme {
        padding: 4px 25px;
        background: $color-gold;
        color: $color-black;
        border-radius: $border-radius-small;
        font-size: 24px;
        font-family: Raleway, sans-serif;
        font-weight: 300;
    }

    &__content {
        margin-top: 15px;
    }

    &__image {
        width: 100%;
        border-radius: $border-radius;
        max-height: 470px;
        object-fit: cover;
    }

    &__copyright {
        font-size: 16px;
        font-family: Raleway, sans-serif;
        font-weight: 300;
        margin-top: 35px;
    }

    &__description {
        margin-top: 25px;
        font-size: 16px;
        font-family: Roboto, sans-serif;
        font-weight: 300;
    }

    &__button {
        font-size: 20px;
        font-family: Raleway;
        margin-top: 20px;
        display: inline-block;
        color: $color-gold;
        text-decoration: none;
        font-weight: 300;
    }
}
</style>
