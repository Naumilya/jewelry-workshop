import { defineStore } from "pinia";

export const useUserStore = defineStore("user", {
    state: () => ({
        token: localStorage.getItem("token"),
        name: localStorage.getItem("name"),
        email: localStorage.getItem("email"),
        createdAt: localStorage.getItem("createdAt")
            ? new Date(parseInt(localStorage.getItem("createdAt"), 10) * 1000)
            : null,
    }),
    actions: {
        setUser(data) {
            this.name = data.name;
            this.email = data.email;
            this.token = data.token;
            this.createdAt = new Date(data.created_at * 1000);
            localStorage.setItem("name", data.name);
            localStorage.setItem("email", data.email);
            localStorage.setItem("token", data.token);
            localStorage.setItem("createdAt", data.created_at);
        },
        logout() {
            this.token = null;
            this.name = null;
            this.email = null;
            this.createdAt = null;
            localStorage.removeItem("name");
            localStorage.removeItem("email");
            localStorage.removeItem("token");
            localStorage.removeItem("createdAt");
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
    },
});
