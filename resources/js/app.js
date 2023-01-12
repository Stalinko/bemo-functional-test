import './bootstrap';
import Vue from 'vue'
import Board from "./Components/Board.vue";

const app = new Vue({
    el: '#app',
    template: '<Board />',
    components: {
        Board
    }
});
