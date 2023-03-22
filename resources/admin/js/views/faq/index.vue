<template>
    <section>
        <h1>
            Вопросы и ответы
        </h1>
        <el-tabs type="card" v-model="activeTab">
            <el-tab-pane label="Основная информация" name="main">
        <el-form class="d-flex align-items-end mb-4" :model="form" label-position="top">
            <el-form-item  style="margin-bottom: 0; width: 400px; margin-right: 15px" prop="title" label="Заголовок списка">
                <el-input v-model="form.title"></el-input>
            </el-form-item>
            <el-button icon="el-icon-plus" type="primary" @click.prevent="storeList">Добавить список вопросов и ответов</el-button>
        </el-form>
        <el-divider></el-divider>
        <question-list
            v-for="(list, index) in block_lists"
            :key="list.id"
            :block_list="list"
            :index="index"
            @editListItem="editListItem"
            @create="createItem"
            @delete="deleteBlockList"
        ></question-list>
            </el-tab-pane>
            <el-tab-pane label="Настройки и SEO" name="config">
                <Seo :form = "seo" v-if="seo"></Seo>
                <el-button type="success" @click.prevent="submitSeo">Сохранить</el-button>
            </el-tab-pane>
        </el-tabs>
        <el-dialog
            :title="ModalTitle"
            :visible.sync="dialogVisible"
            width="50%"
            :before-close="handleClose">
            <question-list-create
                v-if="dialogVisible && state === 'create'"
                @create="addItem"
                :id="currentId"
            ></question-list-create>
            <question-list-edit
                v-if="dialogVisible && state === 'edit'"
                :id="currentId"
                :item="currentListItemData"
                @edit="updateItem"
            ></question-list-edit>
        </el-dialog>
    </section>
</template>
<script>
import { Errors } from  '@/common/js/services/errors.js';
import QuestionList from "./QuestionList";
import QuestionListCreate from './QuestionListCreate';
import QuestionListEdit from "./QuestionListEdit";
import Seo from '@/admin/js/components/seo/seo.vue'
    export default {
        computed: {
            ModalTitle: function (){
                if(this.state === 'create') {
                    return "Новый элемент списка"
                }
                else if(this.state === 'edit') {
                    return "Редактировать элемент списка"
                }
                else {
                    return "";
                }
            }
        },
        components: {
            QuestionList, QuestionListCreate,QuestionListEdit, Seo,
        },
        data() {
            return {
                activeTab: 'main',
                seo: {
                    title: "",
                    description: "",
                    keywords: "",
                },
                currentListItemData: null,
                currentId: null,
                state:"",
                dialogVisible:false,
                block_lists:[],
                form: {
                    title: "",
                    type:"faq",
                    list:[]
                },
                errors: new Errors(),
            }
        },
        methods: {
            editListItem(data) {
                this.currentId = data.id;
                this.currentListItemData = data.item;
                this.state = 'edit';
                this.dialogVisible = true;
            },
            addItem(data) {
                console.log(data);
               let index =  this.block_lists.findIndex(object => {
                    return object.id === this.currentId
                })
                this.block_lists[index].list.push(data);
                this.closeModal();
            },
            updateItem(item) {
                let index =  this.block_lists.findIndex(object => {
                    return object.id === this.currentId
                })
                this.block_lists[index].list[item.index] = item.data;
                this.closeModal();
            },
            createItem(id) {
                this.currentId = id;
                this.state = 'create';
                this.dialogVisible = true;
            },
            closeModal() {
                this.dialogVisible = false;
                this.currenId = null;
                this.state = '';
                this.currentListItemData=null;
            },
            handleClose() {
                this.closeModal();
            },
            deleteBlockList(id) {
             let index = this.block_lists.findIndex(object => {
                    return object.id === id;
                })
                this.block_lists.splice(index,1);
            },
            getBlockLists() {
                    axios.get('/api/admin/block-lists', {params: {type:'faq'}})
                        .then((response) => {
                            this.block_lists = response.data;
                        })
            },
            storeList(){
                axios.post('/api/admin/block-lists ', this.form)
                    .then((response) => {
                        this.block_lists.push(response.data);
                    })
            },
        },
        mounted() {
            this.getBlockLists();
        }
    }
</script>
