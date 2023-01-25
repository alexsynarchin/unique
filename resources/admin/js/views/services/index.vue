<template>
    <section >
        <h1>Дополнительные услуги</h1>
        <div class="mb-3">
            <el-button type="success" icon="el-icon-plus" @click="serviceModalOpen('create')">Добавить</el-button>
        </div>
        <data-tables :data="services">
            <el-table-column
                type="index"
                label="№"
            >
            </el-table-column>
            <el-table-column
                label="Логотип"
                prop="logo"
            >
                <template slot-scope="scope">
                    <img :src="scope.row.logo" style="max-width: 150px">
                </template>
            </el-table-column>
            <el-table-column
                label="Название"
                prop="title"
                sortable
            >
            </el-table-column>
            <el-table-column
                label="Стоимость"
                prop="price"
                sortable
            >
            </el-table-column>
            <el-table-column
                label="Действия"
            >

                <template slot-scope="scope">
                    <el-button
                        size="mini"
                        type="primary"
                        @click="handleEdit(scope.row)">Редактировать</el-button>
                    <el-button
                        size="mini"
                        type="danger"
                        @click="handleDelete(scope.row.id)">Удалить</el-button>
                </template>
            </el-table-column>
        </data-tables>
        <el-dialog
            :before-close="closeModal"
            :visible.sync="showModal"
            width="60%"
            :title="serviceModalTitle"
        >
            <create
                @close="closeModal"
                @store="storeService"
                v-if="showModal && serviceModalStatus === 'create'"></create>
            <edit
                :id="currentId"
                @close="closeModal"
                @update="updateService"
                v-if="showModal && serviceModalStatus === 'edit'"></edit>
        </el-dialog>
    </section>
</template>
<script>
    import create from "./create";
    import edit from "./edit";
    export default {
        components: {
            create, edit,
        },
        computed: {
            serviceModalTitle:function () {
                if(this.serviceModalStatus === 'create') {
                    return 'Новая услуга';
                }
                if(this.serviceModalStatus === 'edit') {
                    return 'Редактировать услугу';
                }
            },
        },
        data() {
            return {
                CanAccess: 'Просмотр "Дополнительные услуги"',
                currentId: null,
                services: [],
                serviceModalStatus: "",
                showModal:false,
            }
        },
        methods: {
            getServices() {
                axios.get('/api/admin/services')
                    .then((response) => {
                        this.services = response.data;
                    })
                    .catch((error) => {

                    })
            },
            storeService(data) {
                this.services.push(data);
                this.closeModal();
            },
            updateService(data) {
                let index = this.services.findIndex(object => {
                    return object.id === data.id;
                });
                this.services[index] = data;
                this.closeModal();
            },
            serviceModalOpen(status) {
                this.serviceModalStatus = status;
                this.showModal = true;
            },
            handleEdit(item) {
                this.currentId = item.id;
                this.serviceModalStatus = 'edit';
                this.showModal = true;
            },
            handleDelete(id) {

                axios.delete('/api/admin/service/' + id)
                    .then((response) => {
                        let index = this.services.findIndex(object => {
                            return object.id === id;
                        });
                        this.services.splice(index,1)
                    })
            },
            closeModal()
            {
                this.currentId = null;
                this.showModal = false;
            }
        },
        mounted() {
            this.getServices();
        }
    }
</script>
