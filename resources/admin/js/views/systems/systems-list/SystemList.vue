<template>
    <section>
        <el-menu  default-active="/check-systems/list"   class="el-menu-demo" mode="horizontal"  :router="true"  >
            <el-menu-item index='/check-systems/list' >Системы проверки</el-menu-item>
            <el-menu-item index="/check-systems/api">Api систем проверки</el-menu-item>
        </el-menu>
        <div class="col-md-10">
            <div class="d-flex mb-3 mt-2">
                <div style="margin-right: 20px">
                    <el-button type="success" icon="el-icon-plus" @click.prevent="openModal('create', null)">Добавить систему проверки</el-button>
                </div>
                <div style="width: 300px">
                    <el-input
                        v-model="filters[0].value"
                        size="large"
                        width="100%"
                        placeholder="Название системы проверки"/>
                </div>
            </div>
            <el-table-draggable @drop="endSort" >
                <el-table row-key="menuindex" :data="tableData">
                    <el-table-column width="26px">
                        <template>
                            <i class="el-icon-rank" style="cursor: pointer"></i>
                        </template>
                    </el-table-column>
                <el-table-column
                    type="index"
                >
                </el-table-column>
                <el-table-column
                    label="Название"
                    prop="title"
                    width="200"
                    sortable
                >
                </el-table-column>
                <el-table-column
                    label="Стоимость, руб"
                    prop="price"
                    width="200"
                    sortable
                >
                </el-table-column>
                <el-table-column
                    label="Сервис Api"
                    sortable
                >
                    <template slot-scope="scope" >
                        <template v-if="scope.row.check_api">
                                    {{scope.row.check_api.title}}
                        </template>
                        <template  v-else>
                            Ручная проверка
                        </template>
                    </template>
                </el-table-column>
                <el-table-column
                    label="Действия"
                >
                <template slot-scope="scope">
                    <el-button type="primary" size="small" @click.prevent="openModal('edit', scope.row.id)">
                        Редактировать
                    </el-button>
                    <el-button type="danger" size="small" @click.prevent="removeSystem(scope.row.id)">
                        Удалить
                    </el-button>
                </template>
                </el-table-column>
                </el-table>
            </el-table-draggable>
        </div>
        <el-dialog
            :title="modalTitle"
            :visible.sync="modalVisible"
            width="50%"
            :before-close="handleClose"
        >
            <edit
                v-if="modalState === 'edit' && systemEditId"
                :id="systemEditId"
                @closeModal="closeModal"
            ></edit>
            <create
                @closeModal="closeModal"
                v-if="modalState === 'create'"></create>
        </el-dialog>

    </section>
</template>
<script>
import Create from './create.vue';
import Edit from "./edit.vue";
import ElTableDraggable from 'element-ui-el-table-draggable';
    export default {
        components: {
            Create, Edit,  'ElTableDraggable': ElTableDraggable,
        },
        data() {
            return {
                systemEditId: null,
                modalVisible:false,
                tableData:[],
                modalState:"",
                filters: [{
                    prop: 'title',
                    value: ''
                }],
            }
        },
        computed: {
            modalTitle: function () {
                let title = "";
              if(this.modalState === 'edit') {
                  title = "Редактироваить систему проверки"
              }
              else {
                  title = "Добавить систему проверки"
              }
              return title;
            },
        },
        methods: {
            endSort(e) {
                console.log(e)
                var valuesSort = this.tableData.map(function (item, i) {
                    var sortItem = {};
                    sortItem.menuindex = i;
                    sortItem.id = item.id;
                    sortItem.name = item.name;
                    return sortItem;
                });
                axios.post('/api/admin/sort',{sort:valuesSort, model:'CheckSystem'})
                    .then((response) => {
                        console.log(response.data);
                    })
            },
            getList() {
                axios.get('/api/admin/check-systems')
                    .then((response) => {
                        this.tableData = response.data;
                    })
            },
            handleClose() {
                this.modalState="";
                this.modalVisible = false;
                this.systemEditId = null;
            },
            closeModal(type){
                if(type === 'save') {
                    this.getList();
                }
                this.modalState="";
                this.systemEditId = null;
                this.modalVisible = false;
            },
            openModal(type ,id) {
                this.systemEditId = id;
                this.modalState = type;
                this.modalVisible = true;
            },
            removeSystem(id) {
                    this.$confirm('Вы уверены что хотите удалить систему проверки', 'Удаление системы проверки', {
                        confirmButtonText: 'Удалить',
                        cancelButtonText: 'Отмена',
                        type: 'warning'
                    }).then(() => {
                        axios.post('/api/admin/check-system/' + id + '/destroy')
                            .then((response) => {
                                this.$message({
                                    type: 'success',
                                    message: 'Удаление завершено'
                                });
                                this.getList();
                            })
                    }).catch(() => {
                        this.$message({
                            type: 'info',
                            message: 'Отмена'
                        });
                    });

            },
        },
        mounted() {
            this.getList();
        }
    }
</script>
