/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

import Vue from "vue";

import VueRouter from "vue-router";
Vue.use(VueRouter);

import liff from '@line/liff';
liff.init({ liffId: '1655533907-beDJ2Ody' });

Vue.prototype.liff = liff;


const routers = new VueRouter({
    // mode: "history",
    // base: '/vue/',
    routes: [{
            path: "/",
            name: "home",
            component: () =>
                import ("./components/welcome.vue"),
        },
        {
            path: "/liff",
            name: "liff",
            component: () =>
                import ("./components/liff.vue"),
        },
        {
            path: "*",
            redirect: "/",
        }, // catch all use case
    ],
});

const app = new Vue({
    el: "#app",
    router: routers,

});