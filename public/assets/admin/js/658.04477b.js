"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[658],{95844:(e,t,r)=>{function o(e,t){for(var r=0;r<t.length;r++){var o=t[r];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}r.d(t,{D:()=>i});var i=function(){function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.errors={}}var t,r,i;return t=e,(r=[{key:"has",value:function(e){return this.errors.hasOwnProperty(e)}},{key:"any",value:function(){return Object.keys(this.errors).length>0}},{key:"get",value:function(e){if(this.errors[e])return this.errors[e][0]}},{key:"getFlash",value:function(e){if(this.errors[e])return this.errors[e]}},{key:"record",value:function(e){this.errors=e}},{key:"clear",value:function(e){e?this.has(e)&&delete this.errors[e]:this.errors={}}}])&&o(t.prototype,r),i&&o(t,i),Object.defineProperty(t,"prototype",{writable:!1}),e}()},70658:(e,t,r)=>{r.r(t),r.d(t,{default:()=>d});var o=r(95844);const i={props:{saveMsg:{default:"Услуга добавлена"},form:{type:Object},formAction:{type:Object}},data:function(){return{errors:new o.D}},methods:{submitForm:function(){var e=this;axios({method:this.formAction.method,url:this.formAction.url,data:this.form}).then((function(t){e.$message({message:e.saveMsg,type:"success"}),e.$emit("submit",t.data)})).catch((function(t){e.errors.record(t.response.data.errors)}))},uploadImage:function(e){var t=this.beforeImageUpload(e.raw);this.form.logoName=e.raw.name,console.log(t),t&&this.createImage(e)},beforeImageUpload:function(e){var t="image/jpeg"===e.type,r="image/png"===e.type,o=e.size/1024/1024<2;return t||r||this.$message.error("Картинка должна быть в формате jpeg или png"),o||this.$message.error("Размер не может превышать 2МБ"),(t||r)&&o},createImage:function(e){var t=new FileReader,r=this;t.onload=function(e){r.form.logo=e.target.result},t.readAsDataURL(e.raw)}},mounted:function(){}};var n=r(51900);const s=(0,n.Z)(i,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("el-form",{attrs:{model:e.form,"label-position":"top"}},[r("el-form-item",{attrs:{prop:"title",label:"Название",error:e.errors.get("title")}},[r("el-input",{model:{value:e.form.title,callback:function(t){e.$set(e.form,"title",t)},expression:"form.title"}})],1),e._v(" "),r("el-form-item",{attrs:{prop:"price",label:"Стоимость"}},[r("el-input-number",{attrs:{min:0},model:{value:e.form.price,callback:function(t){e.$set(e.form,"price",t)},expression:"form.price"}})],1),e._v(" "),r("el-form-item",{attrs:{prop:"price_@",label:"Стоимость для не РФ"}},[r("el-input-number",{attrs:{min:0},model:{value:e.form.price_2,callback:function(t){e.$set(e.form,"price_2",t)},expression:"form.price_2"}})],1),e._v(" "),r("el-form-item",{attrs:{prop:"description",label:"Описание"}},[r("el-input",{attrs:{type:"textarea",rows:"6"},model:{value:e.form.description,callback:function(t){e.$set(e.form,"description",t)},expression:"form.description"}})],1),e._v(" "),r("el-button",{attrs:{type:"success"},on:{click:function(t){return t.preventDefault(),e.submitForm.apply(null,arguments)}}},[e._v("Сохранить")])],1)}),[],!1,null,null,null).exports,a={components:{ServiceForm:s},data:function(){return{form:{title:"",logo:null,price:0,price_2:0,description:""},formAction:{url:"/api/admin/service",method:"post"}}},methods:{submit:function(e){this.$emit("store",e)}}};const l=(0,n.Z)(a,(function(){var e=this,t=e.$createElement;return(e._self._c||t)("service-form",{attrs:{form:e.form,"form-action":e.formAction},on:{submit:e.submit}})}),[],!1,null,null,null).exports;const c={components:{ServiceForm:s},props:{id:{type:Number}},data:function(){return{loaded:!1,form:{},formAction:{url:"/api/admin/service/"+this.id,method:"put"},saveMsg:"Информация обновлена"}},methods:{getData:function(){var e=this;axios.get("/api/admin/service/"+this.id).then((function(t){e.form=t.data,e.loaded=!0}))},submit:function(e){this.$emit("update",e)}},mounted:function(){this.getData()}};const u={components:{create:l,edit:(0,n.Z)(c,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return e.loaded?r("service-form",{attrs:{"form-action":e.formAction,form:e.form,"save-msg":e.saveMsg},on:{submit:e.submit}}):e._e()}),[],!1,null,null,null).exports},computed:{serviceModalTitle:function(){return"create"===this.serviceModalStatus?"Новая услуга":"edit"===this.serviceModalStatus?"Редактировать услугу":void 0}},data:function(){return{CanAccess:'Просмотр "Дополнительные услуги"',currentId:null,services:[],serviceModalStatus:"",showModal:!1}},methods:{getServices:function(){var e=this;axios.get("/api/admin/services").then((function(t){e.services=t.data})).catch((function(e){}))},storeService:function(e){this.services.push(e),this.closeModal()},updateService:function(e){var t=this.services.findIndex((function(t){return t.id===e.id}));this.services[t]=e,this.closeModal()},serviceModalOpen:function(e){this.serviceModalStatus=e,this.showModal=!0},handleEdit:function(e){this.currentId=e.id,this.serviceModalStatus="edit",this.showModal=!0},handleDelete:function(e){var t=this;axios.delete("/api/admin/service/"+e).then((function(r){var o=t.services.findIndex((function(t){return t.id===e}));t.services.splice(o,1)}))},closeModal:function(){this.currentId=null,this.showModal=!1}},mounted:function(){this.getServices()}};const d=(0,n.Z)(u,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("section",[r("h1",[e._v("Дополнительные услуги")]),e._v(" "),r("div",{staticClass:"mb-3"},[r("el-button",{attrs:{type:"success",icon:"el-icon-plus"},on:{click:function(t){return e.serviceModalOpen("create")}}},[e._v("Добавить")])],1),e._v(" "),r("data-tables",{attrs:{data:e.services}},[r("el-table-column",{attrs:{type:"index",label:"№"}}),e._v(" "),r("el-table-column",{attrs:{label:"Логотип",prop:"logo"},scopedSlots:e._u([{key:"default",fn:function(e){return[r("img",{staticStyle:{"max-width":"150px"},attrs:{src:e.row.logo}})]}}])}),e._v(" "),r("el-table-column",{attrs:{label:"Название",prop:"title",sortable:""}}),e._v(" "),r("el-table-column",{attrs:{label:"Стоимость",prop:"price",sortable:""}}),e._v(" "),r("el-table-column",{attrs:{label:"Действия"},scopedSlots:e._u([{key:"default",fn:function(t){return[r("el-button",{attrs:{size:"mini",type:"primary"},on:{click:function(r){return e.handleEdit(t.row)}}},[e._v("Редактировать")]),e._v(" "),r("el-button",{attrs:{size:"mini",type:"danger"},on:{click:function(r){return e.handleDelete(t.row.id)}}},[e._v("Удалить")])]}}])})],1),e._v(" "),r("el-dialog",{attrs:{"before-close":e.closeModal,visible:e.showModal,width:"60%",title:e.serviceModalTitle},on:{"update:visible":function(t){e.showModal=t}}},[e.showModal&&"create"===e.serviceModalStatus?r("create",{on:{close:e.closeModal,store:e.storeService}}):e._e(),e._v(" "),e.showModal&&"edit"===e.serviceModalStatus?r("edit",{attrs:{id:e.currentId},on:{close:e.closeModal,update:e.updateService}}):e._e()],1)],1)}),[],!1,null,null,null).exports}}]);
//# sourceMappingURL=658.04477b.js.map