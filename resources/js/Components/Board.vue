<template>
    <div class="board">
        <Column v-for="column in columns" :column="column" :key="column.id"></Column>
        <AddColumnButton @click.native="addColumn()" />
    </div>
</template>

<script>
import Column from "./Column.vue";
import AddColumnButton from "./AddColumnButton.vue";

export default {
    components: {AddColumnButton, Column},
    data: () => ({
        columns: []
    }),
    name: "Board",
    created() {
        this.loadColumns();
    },
    methods: {
        loadColumns() {
            axios.get('columns').then(response => {
                this.$data.columns = response.data
            })
        },

        addColumn() {
            axios.post('columns', {title: 'New Column'}).then(response => {
                const column = response.data;
                column.cards = [];

                this.$data.columns.push(column)
            })
        }
    }
}
</script>

<style scoped>

</style>
