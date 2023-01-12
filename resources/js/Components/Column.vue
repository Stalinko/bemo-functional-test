<template>
    <div class="column">
        <div class="column__title" contenteditable="true" @input="updateTitle">{{ column.title }}</div>
    </div>
</template>

<script>
export default {
    props: ['column'],
    name: "Column",
    methods: {
        updateTitle: _.debounce(function (event) {
            const title = event.target.innerText;
            if (!title) {
                return;
            }

            axios.put('columns/' + this.column.id, {title});
        }, 300)
    }
}
</script>

<style scoped>

</style>
