<template>
    <div class="card">
        <DeleteButton @click.native="deleteCard" />

        {{ card.title }}
    </div>
</template>

<script>
import DeleteButton from "./DeleteButton.vue";

export default {
    components: {DeleteButton},
    props: ['card'],
    name: "Card",

    methods: {
        deleteCard() {
            axios.delete('cards/' + this.card.id)
            this.$emit('deleted')
        }
    }
}
</script>

<style scoped>

</style>
