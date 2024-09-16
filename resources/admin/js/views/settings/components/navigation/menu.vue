<template>
    <div class="col-md-6 mb-3">
        <el-card class="box-card" style="height: 100%">
            <div slot="header">
                <h5 class="mb-0">{{menu.title}}</h5>
            </div>
            <draggable v-model="menu.items"  tag="ul" class="building-option-item__values-list" @end="endSort" handle=".building-option-value-item__handle">
                <menu-item
                    :key="menu.id"
                    v-for="(item, index) in menu.items"
                    :item="item"
                    :index = "index"
                    @editItem="editItem(index, ...arguments)"
                    @deleteItem="deleteItem(item)"
                ></menu-item>
            </draggable>
            <el-button size="small" type="primary" icon="el-icon-plus" @click.prevent="modalOpen('new')">Добавить пункт меню</el-button>
        </el-card>
        <el-dialog
            :visible.sync="ModalShow"
            :title = "ModalTitle"
            @closed="resetForm('form')"
        >
            <el-form ref="form" :model="menuForm" label-position="top" :rules="rules">
                <div class="row">
                    <el-form-item prop="title" label="Заголовок" class="col-md-6">
                        <el-input
                            v-model="menuForm.title"
                        >
                        </el-input>
                    </el-form-item>
                    <el-form-item prop="link" label="Ссылка на страницу" class="col-md-6">
                        <el-input
                            v-model="menuForm.link"
                        >
                        </el-input>
                    </el-form-item>
                </div>
                <el-button type="primary" icon="el-icon-plus" size="small" @click.prevent="addNewItem('form')" v-if="ModalStatus === 'new'">Добавить</el-button>
                <el-button type="primary" icon="el-icon-plus" size="small" @click.prevent="updateItem('form')" v-else>Обновить</el-button>
                <el-button type="danger" icon="el-icon-close" size="small" @click.prevent="closeModal()">Закрыть</el-button>
            </el-form>
        </el-dialog>
    </div>
</template>
<script>
import draggable from 'vuedraggable';
import MenuItem from './MenuItem';
import { Errors } from  '@/common/js/services/errors.js';
export default {
    props:['menu'],
    computed: {
        ModalTitle:function () {
            if(this.ModalStatus === 'new') {
                return 'Новый пункт меню';
            }
            if(this.ModalStatus === 'edit') {
                return 'Редактировать пункт меню';
            }
        },
    },
    data() {
        return {
            errors: new Errors(),
            ModalShow:false,
            ModalStatus:'',
            itemIndex:null,
            newForm: {
                id:null,
                title:'',
                link:'',
                menuindex:0,
                position:this.menu.position
            },
            menuForm:{},
            rules:{
                title:[
                    { required: true, message: 'Введите заголовок', trigger: 'blur' },
                ],
                link:[
                    { required: true, message: 'Введите ссылку', trigger: 'blur' },
                ]
            },
        }
    },
    components:{
        MenuItem, draggable,
    },
    methods:{
        editItem(index, item) {
            this.menuForm = Object.assign({},item);
            this.itemIndex = index;
            this.modalOpen('edit');
        },
        deleteItem(item) {
            this.menu.items.splice(this.menu.items.indexOf(item), 1);
        },
        modalOpen(status) {
            this.ModalStatus = status;
            if (status === 'new') {
                this.menuForm = Object.assign({},this.newForm)
            }
            this.ModalShow = true;
        },
        endSort(e) {

            var valuesSort = this.menu.items.map(function (item, i) {
                var sortItem = {};
                sortItem.menuindex = i;
                sortItem.id = item.id;
                sortItem.title = item.title;
                return sortItem;
            });
            axios.post('/api/admin/menu/' + this.menu.position + '/sort',{sort:valuesSort})
                .then((response) => {
                    console.log(response.data);
                })

        },
        addNewItem(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.menuForm.menuindex = this.menu.items.length;
                    axios.post('/api/admin/menu/store', this.menuForm)
                        .then((response) => {
                            this.menu.items.push(response.data);
                            this.closeModal();
                        })
                        .catch((error) => {
                            console.log(error);
                            this.errors.record(error.response.data.errors)
                        });

                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        updateItem(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.menuForm.menuindex = this.menu.items.length;
                    axios.post('/api/admin/menu/' + this.menuForm.id + '/update', this.menuForm)
                        .then((response) => {
                            console.log(response.data);
                            this.menu.items[this.itemIndex] = response.data;
                            this.closeModal();
                        })
                        .catch((error) => {
                            console.log(error);
                            this.errors.record(error.response.data.errors)
                        });

                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        closeModal() {
            this.ModalShow = false;
        },
        getItems() {
            axios.get('/api/admin/menu/get/' + this.menu.position)
                .then((response) => {
                    this.menu.items = response.data;
                })
        },
        resetForm(formName) {
            this.$refs[formName].resetFields();
        },
    },

    mounted() {
        this.getItems();
    }
}
</script>
