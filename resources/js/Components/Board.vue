<template>
    <div class="board">
        <Column v-for="column in columns" :column="column" :key="column.id" @deleted="removeColumn(column)"></Column>
        <AddColumnButton @click.native="addColumn()" />

        <ExportButton />
    </div>
</template>

<script>
import Column from "./Column.vue";
import AddColumnButton from "./AddColumnButton.vue";
import ExportButton from "./ExportButton.vue";

export default {
    components: {ExportButton, AddColumnButton, Column},
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
        },

        removeColumn(column) {
            this.columns = _.reject(this.columns, column)
        }
    }
}
</script>
