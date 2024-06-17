import axios from "axios";
import { defineStore } from "pinia";

export const useUserStore = defineStore("user", {
    state: () => ({
        id: localStorage.getItem("userId") || null,
        token: localStorage.getItem("token") || null,
        name: localStorage.getItem("name") || null,
        email: localStorage.getItem("email") || null,
        createdAt: localStorage.getItem("createdAt")
            ? new Date(parseInt(localStorage.getItem("createdAt"), 10) * 1000)
            : null,
        orders: JSON.parse(localStorage.getItem("orders")) || [],
    }),

    actions: {
        async fetchOrdersByUserId(userId) {
            if (!this.token) return;

            try {
                const response = await axios.get(
                    `/api/orders?userId=${userId}`,
                    {
                        headers: {
                            Authorization: `Bearer ${this.token}`,
                        },
                    }
                );

                if (response.data.status === "success") {
                    this.orders = response.data.orders;
                    localStorage.setItem("orders", JSON.stringify(this.orders));
                } else {
                    console.error(
                        "Failed to fetch orders:",
                        response.data.message
                    );
                }
            } catch (error) {
                console.error("Error fetching orders:", error);
            }
        },

        setUser(data) {
            const { id, name, email, token, created_at } = data;
            this.id = id;
            this.name = name;
            this.email = email;
            this.token = token;
            this.createdAt = new Date(created_at * 1000);

            localStorage.setItem("userId", id);
            localStorage.setItem("name", name);
            localStorage.setItem("email", email);
            localStorage.setItem("token", token);
            localStorage.setItem("createdAt", created_at);
        },

        logout() {
            this.id = null;
            this.token = null;
            this.name = null;
            this.email = null;
            this.createdAt = null;
            this.orders = [];

            localStorage.removeItem("userId");
            localStorage.removeItem("name");
            localStorage.removeItem("email");
            localStorage.removeItem("token");
            localStorage.removeItem("createdAt");
            localStorage.removeItem("orders");
        },

        getFormattedDate() {
            if (!this.createdAt) return null;

            const day = this.createdAt.getDate().toString().padStart(2, "0");
            const month = (this.createdAt.getMonth() + 1)
                .toString()
                .padStart(2, "0");
            const year = this.createdAt.getFullYear();

            return `${day}.${month}.${year}`;
        },

        addOrder(order) {
            this.orders.push(order);
            localStorage.setItem("orders", JSON.stringify(this.orders));
        },
    },
});
