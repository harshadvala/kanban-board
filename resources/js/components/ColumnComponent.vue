<template>
    <div class="column">
        <div class="column-title flex justify-between">
            <h2>
                {{ column.title }}
            </h2>
            <span class="close" v-on:click="onDelete(column.id)">X</span>
        </div>

        <div class="cards">
            <draggable
                class="dragArea list-group"
                :list="cards"
                @end="onEnd"
                group="cards"
                item-key="id">
                <template #item="{ element }">
                    <card-component @click="editTask(element)" :detail="element"></card-component>
                </template>
            </draggable>

        </div>

        <vue-final-modal
            v-model="showModal"
            classes="modal-container"
            content-class="modal-content">

            <button class="modal-close" @click="showModal = false">
                x
            </button>

            <div class="header">
                <b>Task Detail</b>
            </div>
            <div class="input-group">
                <label>Title</label>
                <input id="card-title" v-model="taskDetail.title" class="input">
            </div>
            <div class="input-group">
                <label>Description</label>
                <textarea v-model="taskDetail.description" rows="4" class="input"></textarea>
            </div>

            <div>
                <button class="btn-add" @click="saveTask()">Save</button>
                <button @click="showModal = false">Close</button>

                <button v-if="taskDetail.id" class="btn-delete" @click="deleteCard(taskDetail)">Delete</button>
            </div>

        </vue-final-modal>

        <button class="btn add-card-btn" @click="newCard">+ Add a card</button>
    </div>
</template>

<script>
import CardComponent from "./CardComponent";
import draggable from 'vuedraggable'
import {$vfm, VueFinalModal, ModalsContainer} from 'vue-final-modal'

import DemoLoginModal from './Modal_Login.vue'

export default {
    components: {
        CardComponent, draggable, DemoLoginModal, VueFinalModal,
        ModalsContainer
    },
    props: ['column'],
    data() {
        return {
            cards: (this.column && this.column.cards) ? this.column.cards : [],
            showModal: false,
            isSaving: false,
            taskDetail: {
                title: '',
                description: '',
                column_id: this.column.id,
                id: ''
            }
        }
    },
    methods: {
        newCard: function (evt) {
            this.showModal = true;
            this.taskDetail = {
                title: '',
                description: '',
                column_id: this.column.id
            };

            setTimeout(function () {
                document.getElementById('card-title').focus();
            }, 500);
        },
        editTask: function (task) {
            this.taskDetail = Object.assign({}, task);
            this.showModal = true;
            setTimeout(function () {
                document.getElementById('card-title').focus();
            }, 500);
        },
        saveTask() {
            console.log(this.taskDetail);
            if (this.taskDetail.title && this.taskDetail.description) {
                this.isSaving = true;
                axios.post('/api/cards', this.taskDetail)
                    .then(response => {
                        this.isSaving = false;
                        this.showModal = false;
                        this.$emit('onRefreshColumns');
                    })
            }
        },
        onEnd: function (evt) {
            this.$emit('onMovedCard');
        },
        onDelete(id) {
            this.$emit('onDeleteColumn', id);
        },
        deleteCard(card) {
            if (confirm("Are you sure?") == true) {
                this.$emit('onDeleteCard', card);
                this.showModal = false;
            }
        }
    }
}
</script>
<style>
.modal-container {
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    position: relative;
    width: 350px;
    padding: 16px;
    background-color: #fff;
    border-radius: 4px;
}


.modal-content .header {
    margin-bottom: 15px;
}

.modal-close {
    position: absolute;
    top: 0;
    right: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 32px;
    height: 32px;
    margin: 8px 8px 0 0;
    cursor: pointer;
    background-color: #ffffff;
    font-size: 20px;
    border: none;
}

.modal-close:hover {
    border-radius: 50%;
    background-color: #e3e0e0;
    padding: 4px;
    transition: background-color 85ms, color 85ms;
}

.btn-delete {
    background-color: #da5151;
    float: right;
    color: #ffffff;
}

</style>

