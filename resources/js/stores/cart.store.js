import axios from "axios";
import { defineStore } from "pinia";

export const useCartStore = defineStore("cart", {
    state: () => ({
        cart: JSON.parse(localStorage.getItem("cart")) || [],
        deferredOrder: JSON.parse(localStorage.getItem("deferredOrder")) || [],
    }),
    actions: {
        addToCart(product) {
            if (!Array.isArray(this.cart)) this.cart = [];
            if (!this.cart.some((item) => item.id === product.id)) {
                this.cart.push(product);
                this.saveCart();
                console.log(`${product.name} added to cart`);
            }
        },
        removeFromCart(product) {
            if (!Array.isArray(this.cart)) this.cart = [];
            this.cart = this.cart.filter((item) => item.id !== product.id);
            this.saveCart();
            console.log(`${product.name} removed from cart`);
        },
        toggleCart(product) {
            if (!Array.isArray(this.cart)) this.cart = [];
            if (this.cart.some((item) => item.id === product.id)) {
                this.removeFromCart(product);
            } else {
                this.addToCart(product);
            }
            console.log(
                `${product.name} is in cart: ${this.isInCart(product)}`
            );
        },
        addToDeferredOrder(product) {
            if (!Array.isArray(this.deferredOrder)) this.deferredOrder = [];
            if (!this.deferredOrder.some((item) => item.id === product.id)) {
                this.deferredOrder.push(product);
                this.saveDeferredOrder();
                console.log(`${product.name} added to deferred order`);
            }
        },
        removeFromDeferredOrder(product) {
            if (!Array.isArray(this.deferredOrder)) this.deferredOrder = [];
            this.deferredOrder = this.deferredOrder.filter(
                (item) => item.id !== product.id
            );
            this.saveDeferredOrder();
            console.log(`${product.name} removed from deferred order`);
        },
        toggleDeferredOrder(product) {
            if (!Array.isArray(this.deferredOrder)) this.deferredOrder = [];
            if (this.deferredOrder.some((item) => item.id === product.id)) {
                this.removeFromDeferredOrder(product);
            } else {
                this.addToDeferredOrder(product);
            }
            console.log(
                `${product.name} is in deferred order: ${this.isInDeferredOrder(
                    product
                )}`
            );
        },
        saveCart() {
            localStorage.setItem("cart", JSON.stringify(this.cart));
        },
        saveDeferredOrder() {
            localStorage.setItem(
                "deferredOrder",
                JSON.stringify(this.deferredOrder)
            );
        },
        async makeOrder(email) {
            try {
                const promises = this.cart.map(async (product) => {
                    const order = {
                        user_id: userStore.id,
                        product_id: product.id,
                        order_date: new Date().toISOString().split("T")[0],
                        delivery_date: new Date(
                            Date.now() + 7 * 24 * 60 * 60 * 1000
                        )
                            .toISOString()
                            .split("T")[0],
                        total_cost: parseFloat(product.cost),
                    };

                    const response = await axios.post("/api/orders", order);
                    return response.data;
                });

                await Promise.all(promises);
                this.clearCart();
                console.log("Orders sent to the database.");
            } catch (error) {
                console.error("Failed to send orders:", error);
            }
        },
        clearCart() {
            this.cart = [];
            this.saveCart();
        },
    },
    getters: {
        isInCart: (state) => (product) =>
            Array.isArray(state.cart) &&
            state.cart.some((item) => item.id === product.id),
        isInDeferredOrder: (state) => (product) =>
            Array.isArray(state.deferredOrder) &&
            state.deferredOrder.some((item) => item.id === product.id),
    },
});
