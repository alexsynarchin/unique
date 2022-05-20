<template>
    <section>
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
            <data-tables :data="tableData">
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
                    <template slot-scope="scope">
                        {{scope.row.check_api.title}}
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
            </data-tables>
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
                v-else></create>
        </el-dialog>

    </section>
</template>
<script>
import Create from './systems-list/create';
import Edit from "./systems-list/edit";
    export default {
        components: {
            Create, Edit
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
