<template>
    <section>
        <h1>
            Стоимость
        </h1>
        <el-form class="d-flex align-items-end mb-4" :model="form" label-position="top">
            <el-form-item  style="margin-bottom: 0; width: 400px; margin-right: 15px" prop="title" label="Заголовок списка">
                <el-input v-model="form.title"></el-input>
            </el-form-item>
            <el-button icon="el-icon-plus" type="primary" @click.prevent="storeList">Добавить список c ценами</el-button>
        </el-form>
        <el-divider></el-divider>
        <price-list
            v-for="(list, index) in block_lists"
            :key="list.id"
            :block_list="list"
            :index="index"
            @create="createItem"
            @delete="deleteBlockList"
        ></price-list>
        <el-dialog
            :title="ModalTitle"
            :visible.sync="dialogVisible"
            width="50%"
            :before-close="handleClose">
            <price-list-create
                v-if="dialogVisible && state === 'create'"
                @create="addItem"
            ></price-list-create>
        </el-dialog>
    </section>
</template>
<script>
import { Errors } from  '@/common/js/services/errors.js';
import PriceList from "./PriceList";
import PriceListCreate from './PriceListCreate';
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
        PriceList, PriceListCreate,
        },
        data() {
            return {
                currentIndex: null,
                state:"",
                dialogVisible:false,
                block_lists:[],
                form: {
                    title: "",
                    type:"price",
                    list:[]
                },
                errors: new Errors(),
            }
        },
        methods: {
            addItem(data) {
                this.block_lists[this.currentIndex].list.push(data);
                this.closeModal();
            },
            createItem(index) {
                this.currentIndex = index;
                this.state = 'create';
                this.dialogVisible = true;
            },
            closeModal() {
                this.dialogVisible = false;
                this.currentIndex = null;
                this.state = '';
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
                    axios.get('/api/admin/block-lists', {params: {type:'price'}})
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
