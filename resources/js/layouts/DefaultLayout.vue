<script setup>
import TheFooter from "@/components/Footer/TheFooter.vue";
import TheHeader from "@/components/Header/TheHeader.vue";
</script>

<template>
    <TheHeader />
    <main class="content">
        <slot />
    </main>
    <TheFooter />
</template>

<style lang="scss" scoped></style>
