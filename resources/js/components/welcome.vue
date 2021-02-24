<template>
    <div style="color:white !important; text-align:center">
        <h1 style="color:white !important;">Welcome to Laravel Ft. Vue.js</h1>
        <!-- <button>
            <router-link to="/liff">To Test</router-link>
        </button> -->
        <h1 style="color:white !important;">Api Test</h1>

        <div style="border:2px solid lightblue; text-align:center">
            <h1 style="color:white !important;">Register</h1>
            <label for="fname">Name:</label>
            <input type="text" v-model="form.name" name="fname" /><br />
            <label for="lname">Email:</label>
            <input type="text" v-model="form.email" name="lname" /><br />
            <label for="lname">Password:</label>
            <input type="text" v-model="form.password" name="lname" /><br />
            <button @click="register">Register</button>
            <br /><br>
        </div>

        <div style="border:2px solid lightblue; text-align:center">
            <h1 style="color:white !important;">Login</h1>
            <label for="fname">Email:</label>
            <input type="text" v-model="form2.email" name="fname" /><br />
            <label for="lname">Password:</label>
            <input type="text" v-model="form2.password" name="lname" />
            <br />
            <button @click="login">Login</button>
            <br />
            <textarea :value="uData"></textarea>
            <br />
        </div>

        <div style="border:2px solid lightblue; text-align:center"> 
            <h1 style="color:white !important;">Response</h1>
            <button @click="userlist">UserList</button>
            <br />
            <br />
            <textarea :value="usData"></textarea>
        </div>
    </div>
</template>

<script>
const BACKEND_ENDPOINT = "http://165.22.251.57";

export default {
    data() {
        return {
            id: "",
            form: {
                name: "",
                email: "",
                password: ""
            },
            form2: {
                email: "",
                password: ""
            },
            password: "",
            users: "",
            token: "",
            user: ""
        };
    },
    computed: {
        uData() {
            return JSON.stringify(this.user);
        },
        usData() {
            return JSON.stringify(this.users);
        }
    },
    methods: {
        login() {
            axios
                .post(`${BACKEND_ENDPOINT}/api/auth/login`, {
                    email: this.form2.email,
                    password: this.form2.password
                })
                .then(res => {
                    this.user = res.data;
                    localStorage.setItem("token", res.data.access_token);
                });
        },
        register() {
            axios
                .post(`${BACKEND_ENDPOINT}/api/auth/register`, {
                    name: this.form.name,
                    email: this.form.email,
                    password: this.form.password,
                    password_confirmation: this.form.password
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
                });
        },
        logout() {
            let config = {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`
                }
            };
            axios
                .post(`${BACKEND_ENDPOINT}/api/auth/logout`, config)
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
