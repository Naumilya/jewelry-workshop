<script setup>
import { onMounted, ref } from "vue";

const images = ["/images/slides/slider1.jpg", "/images/slides/slider2.jpg"];

const currentImage = ref(images[0]);
const currentIndex = ref(0);

onMounted(() => {
    setInterval(() => {
        currentIndex.value = (currentIndex.value + 1) % images.length;
        currentImage.value = images[currentIndex.value];
    }, 5000);
});
</script>

<template>
    <main class="main">
        <div class="main__inner container">
            <slot></slot>
        </div>
        <img :src="currentImage" alt="" />
    </main>
</template>

<style lang="scss" scoped>
.main {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;

    img {
        height: 100%;
        max-width: 50%;
    }
}
</style>
