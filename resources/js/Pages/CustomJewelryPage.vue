<script setup>
import { ref } from "vue";

import { useUserStore } from "@/stores/user.store.js";
const userStore = useUserStore();
</script>

<template>
    <section class="custom-jewelry container">
        <h1 class="custom-jewelry__title">Украшения на заказ</h1>
        <p class="custom-jewelry__subtext">
            Если у вас есть идеи или вам надо отремонтировать вашу вещь,
            оставьте вашу заявку здесь
        </p>
        <form action="post" class="custom-jewelry-form custom-jewelry__form">
            <div class="custom-jewelry-form__item">
                <label for="name" class="custom-jewelry-form__label"
                    >Полное имя:</label
                >
                <input
                    class="custom-jewelry-form__input"
                    type="text"
                    id="name"
                    placeholder="Ярослава Щепурушвили Андреевна"
                    :value="userStore.name"
                />
            </div>
            <div class="custom-jewelry-form__item">
                <label for="email" class="custom-jewelry-form__label"
                    >Ваша почта:</label
                >
                <input
                    class="custom-jewelry-form__input"
                    type="email"
                    id="email"
                    placeholder="yaroslavna@gmail.com"
                    :value="userStore.email"
                />
            </div>
            <div class="custom-jewelry-form__item">
                <label for="type" class="custom-jewelry-form__label"
                    >Тип обращение:</label
                >
                <select
                    name="type"
                    id="type"
                    class="custom-jewelry-form__input"
                >
                    <option value="repair">Ремонт</option>
                    <option value="custom">Украшения на заказ</option>
                </select>
            </div>
            <div
                class="custom-jewelry-form__item custom-jewelry-form__item_text-area"
            >
                <label for="massage" class="custom-jewelry-form__label"
                    >Текст обращения</label
                >
                <textarea
                    class="custom-jewelry-form__text-area"
                    name="massage"
                    id="massage"
                ></textarea>
            </div>
            <div
                class="custom-jewelry-form__item custom-jewelry-form__item_buttons"
            >
                <label for="image_uploads" class="button button_white"
                    >Прикрепить файл</label
                >
                <input
                    id="image_uploads"
                    type="file"
                    accept="image/png, image/jpeg, image/jpg"
                    multiple
                    class="image-uploads"
                />
                <button type="submit" class="button">Отправить</button>
            </div>
        </form>
    </section>
</template>

<style lang="scss" scoped>
@import "/resources/css/variables.scss";

.custom-jewelry {
    &__subtext {
        margin-top: 20px;
    }
    &__form {
        margin-top: 80px;
    }
}

.custom-jewelry-form {
    display: flex;
    flex-direction: column;
    gap: 30px;
    &__item {
        display: flex;
        gap: 10px;

        &_text-area {
            flex-direction: column;
        }

        &_buttons {
            display: flex;
            justify-content: space-between;
        }
    }
    &__label {
        font-size: 24px;
        width: 100%;
        max-width: fit-content;
    }
    &__input {
        color: $color-white;
        width: 100%;
        background: none;
        background-color: $color-black;
        border: none;
        outline: none;
        font-size: 24px;
        &::placeholder {
            font-size: 24px;
        }
    }

    &__text-area {
        margin-top: 15px;
        max-width: 100%;
        min-width: 100%;
        width: 100%;
        padding: 20px 15px;
        font-family: Roboto;
        border-color: $color-gold;
        border-radius: $border-radius-small;
        background-color: transparent;
        color: $color-white;
        font-size: 14px;
    }

    .image-uploads {
        display: none;
    }
}
</style>
