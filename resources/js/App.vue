<script setup>
import TheFooter from "@/components/Footer/TheFooter.vue";
import TheHeader from "@/components/Header/TheHeader.vue";
</script>

<template>
    <TheHeader />
    <main class="content container">
        <router-view />
    </main>
    <TheFooter />
</template>

<style scoped lang="scss">
.content {
    margin-top: 75px;
}
</style>
