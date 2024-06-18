<script setup>
import axios from "axios";
import { defineProps, ref } from "vue";

const props = defineProps({
    countOfNews: {
        type: Number,
        default: 10,
        required: false,
    },
    descriptionLength: {
        type: Number,
        default: 100,
        required: false,
    },
});

const newsList = ref([]);

axios
    .get("http://127.0.0.1:8000/api/v1/news/")
    .then((response) => {
        newsList.value = response.data;
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
    <div class="news__list">
        <!-- v-for="news in newsList"
                :key="news.id" -->
        <div
            v-for="(news, index) in newsList.slice(-props.countOfNews)"
            :key="index"
            class="news__item"
        >
            <div class="news__header">
                <h4 class="news__theme">{{ news.theme }}</h4>
                <div class="new__created">
                    {{ dateFormat(news.created_at) }}
                </div>
            </div>
            <div class="news__content">
                <img :src="news.image_path" alt="news" class="news__image" />
                <p class="news__copyright">
                    {{ news.copyright }}
                </p>
                <p class="news__description">
                    {{ news.description.substring(0, props.descriptionLength)
                    }}{{
                        news.description.length > props.descriptionLength
                            ? "..."
                            : ""
                    }}
                </p>
                <router-link class="news__button" :to="`/news/${news.id}`">
                    Читать далее
                </router-link>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
@import "/resources/css/variables.scss";

.news {
    margin-top: 110px;

    &__list {
        margin-top: 37px;
        display: grid;
        grid-template-columns: 1fr;
        gap: 30px;
        @media #{$mq-sm-min} {
            grid-template-columns: repeat(2, 1fr);
            gap: 60px;
        }
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
    }
}
</style>
