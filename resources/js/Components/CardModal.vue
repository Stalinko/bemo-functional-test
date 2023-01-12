<template>
    <div class="card-modal">
        <CloseButton @click.native="$modal.hideAll()" />

        <h2 class="card-modal__header" contenteditable="true" @input="update('title', $event.target.innerText)">{{ initialTitle }}</h2>

        <h3>Description: </h3>
        <div class="card-modal__description" contenteditable="true" @input="update('description', $event.target.innerText)">{{ initialDescription }}</div>
    </div>
</template>

<script>
import CloseButton from "./CloseButton.vue";

export default {
    components: {CloseButton},
    props: ['card'],
    data: function () {
        return {
            initialTitle: this.card.title,
            initialDescription: this.card.description,
        }
    },

    name: "CardModal",

    methods: {
        update: _.debounce(function (prop, value) {
            this.card[prop] = value

            axios.put('cards/' + this.card.id, this.card)
        }, 300)
    }
}
</script>
