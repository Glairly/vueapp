<template>
    <div>
        <h1 style="color:white !important;">Welcome to Vue.js Ft. Laravel</h1>
        <button>
            <router-link to="/liff">To Test</router-link>
        </button>

        <input label="login" />
        <h1 style="color:white !important;">Api Test</h1>
        <input :value="res" />
    </div>
</template>

<script>
export default {
    data() {
        return {
            id: "",
            password: ""
        };
    },
    methods: {
        login() {
            axios.post("/api/auth/login").then(res => {
                this.res = JSON.stringify(res["data"]);
            });
        },
        register(){
            axios.post("/api/auth/login").then(res => {
                this.res = JSON.stringify(res["data"]);
            });
        }
    },
    created() {}
};
</script>
