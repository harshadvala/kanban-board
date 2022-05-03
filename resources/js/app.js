
// require('./bootstrap');
//
// // Require Vue
// window.Vue = require('vue');
// // import Vue from 'vue';
//
// // Register Vue Components
// Vue.component("example-component", require("./components/ExampleComponent.vue"));
//
// // Initialize Vue
// const app = new Vue({
//     el: '#app',
// });



require('./bootstrap');

import {createApp} from 'vue';



import ExampleComponent from './components/ExampleComponent.vue';
import BoardComponent from './components/BoardComponent.vue';
import Draggabe from './components/Draggabe.vue';

let app = createApp({})

app.component('example-component', ExampleComponent);
app.component('board', BoardComponent);
app.component('dragable', Draggabe);
// app.component("example-component", require("./components/ExampleComponent.vue"));

app.mount("#app")
