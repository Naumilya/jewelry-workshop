<script setup>
import TheHeader from "./components/Header/TheHeader.vue";
</script>

<template>
    <TheHeader />
    <main class="main container">
        <router-view />
    </main>
</template>

<style scoped lang="scss">
.main {
    margin-top: 75px;
}
</style>
