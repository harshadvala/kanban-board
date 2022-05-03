<template>
    <div class="board">
        <h2 class="title">Kanban Board</h2>
        <div class="board-main-content">
            <div class="columns">
                <div v-for="(column, index) in columns">
                    <column-component @onMovedCard="refreshColumns" @onRefreshColumns="reloadColumns"
                                      @onDeleteColumn="deleteColumn"
                                      @onDeleteCard="onDeleteCard"
                                      :column="column"></column-component>
                </div>

                <div class="column add-new">
                    <div v-if="!isAdding" class="column-title" v-on:click="addNewColumn">
                        <h2 class="">+ Add Another list</h2>
                    </div>

                    <div v-if="isAdding">
                        <input class="input" type="text" id="column-title-input" v-on:keyup.enter="create"
                               v-model="columnTitle"
                               placeholder="Enter list title">
                        <div class="buttons">
                            <button class="btn-add" v-on:click="create">+ Add</button>
                            <button class="btn-cancel" v-on:click="isAdding=false;">X</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ColumnComponent from "./ColumnComponent";

export default {
    components: {ColumnComponent},
    data() {
        return {
            columns: [],
            isAdding: false,
            columnTitle: ''
        }
    },

    methods: {
        loadColumns() {
            axios.get('/api/columns')
                .then(response => {
                    this.columns = [];
                    this.columns = response.data;
                })
        },
        loadColumn(id) {
            return this.loadColumns();
        },
        reloadColumns() {
            this.columns = [];
            this.loadColumns();
        },
        update(data) {
            axios.put('/api/columns-seq', data)
                .then(response => {
                    console.log(response.data);
                })
        },
        create() {
            if (this.columnTitle) {
                axios.post('/api/columns', {title: this.columnTitle})
                    .then(response => {
                        this.columnTitle = '';
                        this.isAdding = false;
                        this.loadColumns();
                    })
            }
        },
        deleteColumn(id) {
            axios.delete('/api/columns/' + id)
                .then(response => {
                    this.loadColumns();
                })

        },
        onDeleteCard(card) {
            axios.delete('/api/cards/' + card.id)
                .then(response => {
                    this.columns = [];
                    this.loadColumns();
                })
        },
        refreshColumns: function () {
            this.update(this.columns);
        },
        addNewColumn: function () {
            this.isAdding = true;
            setTimeout(function () {
                document.getElementById('column-title-input').focus();
            }, 100);
        }
    },

    mounted() {
        this.loadColumns();
    }

}
</script>
