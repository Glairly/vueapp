<template>
    <div>
        <h1 style="color:white !important;">Welcome to Vue.js Ft. Laravel</h1>
        <!-- <button>
            <router-link to="/liff">To Test</router-link>
        </button> -->
        <h1 style="color:white !important;">Api Test</h1>
        <button @click="login">login</button>
        <button @click="register">register</button>
        <button @click="userlist">UserList</button>

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
                .post("http://127.0.0.1:8000/api/auth/login", {
                    email: "JohnDoe@gmail.com",
                    password: "JohnDoePassword"
                })
                .then(res => {
                    this.user = res.data;
                    localStorage.setItem("token", res.data.access_token);
                });
        },
        register() {
            axios
                .post("http://127.0.0.1:8000/api/auth/register", {
                    name: "oakfap",
                    email: "oakfap@gmail.com",
                    password: "oakfap",
                    password_confirmation: "oakfap"
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
                .get("http://127.0.0.1:8000/api/auth/user-list", config)
                .then(res => {
                    this.users = res.data;
                })
        }
    },
    created() {}
};
</script>
