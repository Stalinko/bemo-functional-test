<template>
    <div class="card" @click="showModal">
        <DeleteButton @click.native="deleteCard" />

        {{ card.title }}
    </div>
</template>

<script>
import DeleteButton from "./DeleteButton.vue";
import CardModal from "./CardModal.vue";

export default {
    components: {DeleteButton},
    props: ['card'],
    name: "Card",

    methods: {
        deleteCard() {
            axios.delete('cards/' + this.card.id)
            this.$emit('deleted')
        },

        showModal() {
            this.$modal.show(
                CardModal,
                { card: this.card }
            )
        }
    }
}
</script>
