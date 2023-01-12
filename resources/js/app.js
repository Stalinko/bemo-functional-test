import './bootstrap';
import Vue from 'vue'
import Board from "./Components/Board.vue";
import VModal from 'vue-js-modal'

const app = new Vue({
    el: '#app',
    template: '<Board />',
    components: {
        Board
    }
});

Vue.use(VModal)
