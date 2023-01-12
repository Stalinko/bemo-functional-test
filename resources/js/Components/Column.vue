<template>
    <div class="column">
        <DeleteButton @click.native="deleteColumn" />

        <div class="column__title" contenteditable="true" @input="updateTitle">{{ column.title }}</div>

        <Card v-for="card in column.cards" :key="card.id" :card="card" @deleted="removeCard(card)" />

        <AddCardButton @click.native="addNewCard" />
    </div>
</template>

<script>
import AddCardButton from "./AddCardButton.vue";
import Card from "./Card.vue";
import DeleteButton from "./DeleteButton.vue";

export default {
    components: {DeleteButton, Card, AddCardButton},
    props: ['column'],
    name: "Column",
    methods: {
        updateTitle: _.debounce(function (event) {
            const title = event.target.innerText;
            if (!title) {
                return;
            }

            axios.put('columns/' + this.column.id, {title});
        }, 300),

        addNewCard() {
            axios.post(`columns/${this.column.id}/cards`, {title: 'New Card'}).then(response => this.column.cards.push(response.data));
        },

        deleteColumn() {
            axios.delete('columns/' + this.column.id)
            this.$emit('deleted')
        },

        removeCard(card) {
            this.column.cards = _.reject(this.column.cards, card);
        }
    }
}
</script>

<style scoped>

</style>
