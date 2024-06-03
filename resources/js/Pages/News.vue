<script setup>
import axios from "axios";
import { ref } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();
const newsItem = ref();

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
    <section class="news container">
        <h1>{{ newsItem.title }}</h1>

        <div class="news__header">
            <h4 class="news__theme">{{ newsItem.theme }}</h4>
            <div class="new__created">
                {{ dateFormat(newsItem.created_at) }}
            </div>
            <div class="news__content">
                <img
                    :src="newsItem.image_path"
                    alt="news"
                    class="news__image"
                />
                <p class="news__copyright">
                    {{ newsItem.copyright }}
                </p>
                <p class="news__description">
                    {{ newsItem.description }}
                </p>
                <router-link class="news__button" to="/">
                    На главную
                </router-link>
            </div>
        </div>
    </section>
</template>

<style lang="scss" scoped></style>
