<template>
    <el-card class="box-card mb-3">
        <div slot="header" >

            <price-list-form
                v-if="editing"
                :form="form"
                :cancel-btn="true"
                @submit="saveTitle"
                @cancel="cancelEditTitle"
                button_text="Сохранить"
                action_type="put"
                :action_url="'/api/admin/block-lists/' + this.block_list.id"
            ></price-list-form>
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
                <price-list-item
                    :key="index"
                    :data="item"
                    v-for="(item, index) in block_list.list"
                    @editListItem="editListItem"
                    @deleteListItem="deleteListItem"
                ></price-list-item>
            </draggable>
        </div>
    </el-card>

</template>
<script>
import PriceListItem from "./PriceListItem";
import PriceListForm from "./components/PriceListForm";
import draggable from 'vuedraggable'
    export default {
        components: {
            PriceListForm, PriceListItem, draggable
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
                    title: "",
                    options: {
                        button:false,
                        label: "",
                    },
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
                this.form.options = this.block_list.options;
            },
            saveTitle(data) {
                this.editing = false;
                this.block_list.title = data.title;
                this.block_list.options= data.options;

            },
            cancelEditTitle() {
              this.editing = false;
            },
        },
    }
</script>
