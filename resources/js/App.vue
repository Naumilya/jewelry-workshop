<script setup>
import { computed } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();
const layout = computed(() => route.meta.layout);
</script>

<template>
    <component :is="layout">
        <router-view />
    </component>
</template>

<style scoped lang="scss">
.content {
    margin-top: 75px;
}
</style>
