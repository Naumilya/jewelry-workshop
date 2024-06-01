<template>
    <router-link to="/" class="logo">
        <span class="logo__name">Золотые руки</span>
        <span class="logo__subtext">Ювелирная мастерская</span>
    </router-link>
</template>

<style scoped lang="scss">
@import "/resources/css/variables.scss";

.logo {
    max-width: max-content;
    display: flex;
    flex-direction: column;
    text-align: center;
    color: $color-white;
    text-decoration: none;
    .logo__name {
        font-weight: 900;
        font-size: 24px;
    }
    .logo__subtext {
        font-size: 14px;
        font-weight: 300;
    }
}
</style>
