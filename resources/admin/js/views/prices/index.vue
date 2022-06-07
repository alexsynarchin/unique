<template>
    <section>
        <h1>
            Стоимость
        </h1>
        <price-list-form
            :form="form"
            button_text="Добавить список c ценами"
            action_type="post"
            action_url="/api/admin/block-lists"
            @submit="storeList"
        ></price-list-form>
        <el-divider></el-divider>
        <price-list
            v-for="(list, index) in block_lists"
            :key="list.id"
            :block_list="list"
            :index="index"
            @editListItem="editListItem"
            @create="createItem"
            @delete="deleteBlockList"
        ></price-list>
        <el-dialog
            :title="ModalTitle"
            :visible.sync="dialogVisible"
            width="50%"
            :before-close="handleClose">
            <price-list-item-create
                v-if="dialogVisible && state === 'create'"
                @create="addItem"
                :id="currentId"
            ></price-list-item-create>
            <price-list-item-edit
                v-if="dialogVisible && state === 'edit'"
                :id="currentId"
                :item="currentListItemData"
                @edit="updateItem"
            ></price-list-item-edit>
        </el-dialog>
    </section>
</template>
<script>
import { Errors } from  '@/common/js/services/errors.js';
import PriceList from "./PriceList";
import PriceListItemCreate from './PriceListItemCreate';
import PriceListItemEdit from "./PriceListItemEdit";
import PriceListForm from "./components/PriceListForm";
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
        PriceList, PriceListItemCreate, PriceListItemEdit, PriceListForm
        },
        data() {
            return {
                currentListItemData: null,
                currentId: null,
                state:"",
                dialogVisible:false,
                block_lists:[],
                form: {
                    title: "",
                    options: {
                        button:false,
                        label: "",
                    },
                    type:"price",
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
                    axios.get('/api/admin/block-lists', {params: {type:'price'}})
                        .then((response) => {
                            this.block_lists = response.data;
                        })
            },
            storeList(data){
                this.block_lists.push(data);
            },
        },
        mounted() {
            this.getBlockLists();
        }
    }
</script>
