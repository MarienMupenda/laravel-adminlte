require("./bootstrap");

window.Vue = require("vue").default;

Vue.component("Items", require("./components/Items.vue").default);

const app = new Vue({
    el: "#app",
});
