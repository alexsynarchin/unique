<template>
    <section class="page-block">
        <div class="mb-3">
            <el-button type="primary" icon="el-icon-plus" @click.prevent="createItem">Добавить элемент</el-button>
        </div>
        <draggable v-model="list"
                   @end="endSort"
                   handle=".building-option-value-item__handle"
        >
            <item
                :key="index"
                :data="item"
                v-for="(item, index) in list"
                @editItem="editItem"
                @deleteItem="deleteItem"
            ></item>
        </draggable>
        <el-dialog
            :title="ModalTitle"
            :visible.sync="dialogVisible"
            width="50%"
            :before-close="handleClose">
            <create-item
                v-if="dialogVisible && state === 'create'"
                type="mp-faq-list"
                @create="addItem"
            ></create-item>
            <edit-item
                v-if="dialogVisible && state === 'edit'"
                :item="currentData"
                @edit = "updateItem"
            ></edit-item>
        </el-dialog>
    </section>
</template>
<script>
import EditItem from "./EditItem";
import CreateItem from "./CreateItem";
import Item from "./Item";
import draggable from 'vuedraggable'
export default {
    data() {
        return {
            dialogVisible:false,
            state: '',
            list: [],
            type:'mp-faq-list',
            currentData: {},
            currentIndex:null,
        }
    },
    components: {
        Item, CreateItem, EditItem, draggable
    },
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
    methods: {
        endSort(e) {
            console.log(e)
            var valuesSort =  this.list.map(function (item, i) {
                var sortItem = {};
                sortItem.menuindex = i;
                sortItem.id = item.id;
                sortItem.name = item.name;
                return sortItem;
            });
            axios.post('/api/admin/sort',{sort:valuesSort, model:'ContentBlock'})
                .then((response) => {
                    console.log(response.data);
                })
        },
        getList() {
            axios.get('/api/admin/content-block/' + this.type + '/list')
                .then((response) => {
                    this.list = response.data;
                })
                .catch((error) => {
                    console.log(error);
                })
        },
        addItem(data) {
            this.list.push(data);
            this.closeModal();
        },
        editItem(item){
            console.log(item);
            this.currentData = item.data;
            this.currentIndex = item.index;
            this.state = 'edit';
            this.dialogVisible = true;
        },
        updateItem(item) {
            this.list[this.currentIndex] = item;
            this.closeModal();
        },
        deleteItem(index){
            this.list.splice(index, 1);
        },
        createItem() {
            this.state = 'create';
            this.dialogVisible = true;
        },
        handleClose() {
            this.closeModal();
        },
        closeModal() {
            this.state = '';
            this.dialogVisible = false;
            this.currentData = {};
            this.currentIndex = null;
        },
    },
    mounted() {
        this.getList();
    }
}
</script>
