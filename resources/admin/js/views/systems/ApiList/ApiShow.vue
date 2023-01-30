<template>
    <section>
        <div class="col-md-10">
            <div class="d-flex mb-3 mt-2">
                <div style="margin-right: 20px">
                    <el-button type="success" icon="el-icon-plus" @click.prevent="openModal('create', null)">Добавить Api аккаунт</el-button>
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
                        label="email"
                        prop="email"
                        width="200"
                        sortable
                    >
                    </el-table-column>
                    <el-table-column
                        label="userkey/API_KEY"
                        prop="key"
                        width="200"
                        sortable
                    >
                    </el-table-column>

                    <el-table-column
                        label="Действия"
                    >
                        <template slot-scope="scope">
                            <el-button type="primary" size="small" @click.prevent="openModal('edit', scope.row.id)">
                                Редактировать
                            </el-button>
                            <el-button type="danger" size="small" @click.prevent="remove(scope.row.id)">
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
                v-if="modalState === 'edit' && editId"
                :id="editId"
                @closeModal="closeModal"
            ></edit>
            <create
                @closeModal="closeModal"
                :api_id="$route.params.id"
                v-if="modalState === 'create'"></create>
        </el-dialog>
    </section>
</template>
<script>
import ElTableDraggable from 'element-ui-el-table-draggable';
import Create from "@/admin/js/views/systems/ApiList/create.vue";
import Edit from "@/admin/js/views/systems/ApiList/edit.vue";
    export default {
        components: {
            Create, Edit,  'ElTableDraggable': ElTableDraggable,
        },
        data() {
            return {
                editId: null,
                modalVisible:false,
                tableData:[],
                modalState:"",
            }
        },
        computed: {
            modalTitle: function () {
                let title = "";
                if(this.modalState === 'edit') {
                    title = "Редактироваить аккаунт api"
                }
                else {
                    title = "Добавить аккаунт api"
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
                axios.post('/api/admin/sort',{sort:valuesSort, model:'ApiAccount'})
                    .then((response) => {
                        console.log(response.data);
                    })
            },
            handleClose() {
                this.modalState="";
                this.modalVisible = false;
                this.editId = null;
            },
            closeModal(type){
                if(type === 'save') {
                    this.getList();
                }
                this.modalState="";
                this.editId = null;
                this.modalVisible = false;
            },
            getList() {
                axios.get('/api/admin/api-accounts' ,{params: {id:this.$route.params.id}})
                    .then((response) => {
                        this.tableData = response.data;
                    })
            },
            openModal(type ,id) {
                this.editId = id;
                this.modalState = type;
                this.modalVisible = true;
            },
            remove(id) {
                this.$confirm('Вы уверены что хотите удалить  аккаунт', 'Удаление аккаунта', {
                    confirmButtonText: 'Удалить',
                    cancelButtonText: 'Отмена',
                    type: 'warning'
                }).then(() => {
                    axios.delete('/api/admin/api-accounts/' + id  )
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
