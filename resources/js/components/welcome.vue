<template>
    <div>
        <h1 style="color:white !important;">Welcome to Laravel Ft. Vue.js</h1>
        <!-- <button>
            <router-link to="/liff">To Test</router-link>
        </button> -->
        <h1 style="color:white !important;">Api Test</h1>
        <button @click="login">Login</button>
        <button @click="register">Register</button>
        <button @click="userlist">UserList</button>
        <button @click="logout">Logout</button>

        <br />
        <br />
        <h1 style="color:white !important;">User</h1>
        <textarea :value="uData"></textarea>
        <br />
        <br />
        <h1 style="color:white !important;">Response</h1>
        <textarea :value="usData"></textarea>
    </div>
</template>

<script>

const BACKEND_ENDPOINT = "http://165.22.251.57";

export default {
    data() {
        return {
            id: "",
            password: "",
            users: "",
            token: "",
            user: ""
        };
    },
    computed:{
        uData(){
            return JSON.stringify(this.user)
        },
        usData(){
            return JSON.stringify(this.users)
        }
    },
    methods: {
        login() {
            axios
                .post(`${BACKEND_ENDPOINT}/api/auth/login`, {
                    email: "test@gmail.com",
                    password: "Test123"
                })
                .then(res => {
                    this.user = res.data;
                    localStorage.setItem("token", res.data.access_token);
                });
        },
        register() {
            axios
                .post(`${BACKEND_ENDPOINT}/api/auth/register`, {
                    name: "Test",
                    email: "test@gmail.com",
                    password: "Test123",
                    password_confirmation: "Test123"
                })
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    console.log(err);
                });
        },
        userlist() {
            let config = {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`
                }
            };
            axios
                .get(`${BACKEND_ENDPOINT}/api/auth/user-list`, config)
                .then(res => {
                    this.users = res.data;
                })
        },
        logout(){
            let config = {
                headers: {
                    'Authorization' : `Bearer ${localStorage.getItem("token")}`
                }
            };
            axios
                .post(`${BACKEND_ENDPOINT}/api/auth/logout`,config)
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    },
    created() {}
};
</script>
