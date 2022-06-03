<template>
    <el-card class="box-card mb-3">
        <div slot="header" >
            <el-form class="d-flex align-items-end mb-4" :model="form" label-position="top" v-if="editing">
                <el-form-item  style="margin-bottom: 0; width: 400px; margin-right: 15px" prop="title" label="Заголовок списка">
                    <el-input v-model="form.title"></el-input>
                </el-form-item>
                <el-button  type="success" @click.prevent="saveTitle">Сохранить заголовок</el-button>
                <el-button type="default" @click.prevent="cancelEditTitle">Отмена</el-button>
            </el-form>
            <section class="d-flex justify-content-between" v-else>
                <span>{{block_list.title}}</span>
                <div class="">
                    <el-button type="primary" icon="el-icon-edit" @click.prevent="editTitle"></el-button>
                    <el-button type="danger" icon="el-icon-delete" @click.prevent="deleteList"></el-button>
                </div>
            </section>
        </div>
        <div class="mb-3">
            <div class="mb-3">
                <el-button type="primary" icon="el-icon-plus" @click.prevent="createItem">Добавить элемент</el-button>
            </div>
            <draggable v-model="block_list.list"
                       @end="endSort"
                       handle=".building-option-value-item__handle"
            >
                <question-list-item
                    :key="index"
                    :data="item"
                    v-for="(item, index) in block_list.list"
                    @editListItem="editListItem"
                    @deleteListItem="deleteListItem"
                ></question-list-item>
            </draggable>
        </div>
    </el-card>

</template>
<script>
import QuestionListItem from "./QuestionListItem";
import draggable from 'vuedraggable'
    export default {
        components: {
            QuestionListItem, draggable
        },
        props: {
            index: {
                type:Number,
            },
            block_list: {
                type:Object,
            }
        },
        data() {
            return {

                editing:false,
                form: {
                    title:"",
                }
            }
        },
        methods: {
            endSort() {

            },
            createItem() {
                this.$emit('create', this.block_list.id);
            },
            editListItem(item) {
                this.$emit('editListItem', {id: this.block_list.id, item: item})
            },
            deleteListItem(index) {
                axios.delete('/api/admin/block-lists/' + this.block_list.id + '/delete-item', {params: {index:index}})
                    .then((response) => {
                        this.block_list.list.splice(response.data, 1);
                    })
            },
            deleteList() {
                axios.delete('/api/admin/block-lists/' + this.block_list.id)
                    .then((response) => {
                        this.$emit('delete', response.data);
                    })
            },
            editTitle() {
                this.editing = true;
                this.form.title = this.block_list.title;
            },
            saveTitle() {
                axios.put('/api/admin/block-lists/' + this.block_list.id, this.form)
                    .then((response) => {
                        this.editing = false;
                        this.block_list.title = this.form.title;
                    })

            },
            cancelEditTitle() {
              this.editing = false;
            },
        },
    }
</script>
