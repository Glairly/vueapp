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
            <br /><br />
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
        <div
            style=" border:2px solid lightblue; text-align:center; width:800px;"
        >
            <h1 style="color:white !important;">Time Series</h1>
            <button @click="getSeries">Update</button>
            <line-chart :chartdata="chart.chartData" :options="chart.options" />
        </div>
    </div>
</template>

<script>
const BACKEND_ENDPOINT = "http://localhost:8000";
import LineChart from "./lineChart.vue";

export default {
    components: {
        LineChart
    },
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
            user: "",
            chart: {
                chartData: {
                    labels: ["0s", "10s", "20s", "30s", "40s", "50s", "60s"],
                    datasets: [
                        {
                            label: "",
                            backgroundColor: "#f87979",
                            data: [0, 0, 0, 0, 0, 0, 0]
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        fontColor: "white"
                    },
                    scales: {
                        yAxes: [
                            {
                                ticks: {
                                    fontColor: "white"
                                }
                            }
                        ],
                        xAxes: [
                            {
                                ticks: {
                                    fontColor: "white"
                                }
                            }
                        ]
                    }
                }
            },
            interval: ""
        };
    },
    computed: {
        uData() {
            return JSON.stringify(localStorage.getItem("user"));
        },
        usData() {
            return JSON.stringify(localStorage.getItem("users"));
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
                    localStorage.setItem("user", res.data);
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
                    localStorage.setItem("users", res.data);
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
        },
        getSeries() {
            let config = {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`
                }
            };
            axios
                .get(`${BACKEND_ENDPOINT}/api/auth/time-series`, config)
                .then(res => {
                    // console.log(res.data)
                    let d = res.data.map(el => el.amount);
                    this.chart.chartData.datasets = [
                        {
                            label: "",
                            backgroundColor: "#f87979",
                            data: d
                        }
                    ];
                })
                .catch(err => {
                    console.log(err);
                });
        }
    },
    created() {
        this.interval = setInterval(() => {
            this.getSeries();
        }, 5000);
    },
    beforeDestroy() {
        clearInterval(this.interval);
    }
};
</script>
