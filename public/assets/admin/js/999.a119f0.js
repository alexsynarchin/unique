"use strict";(self.webpackChunkunique=self.webpackChunkunique||[]).push([[999],{18393:(t,e,a)=>{a.d(e,{A:()=>n});const l={props:["form"],data:function(){return{}}};const n=(0,a(14486).A)(l,(function(){var t=this,e=t._self._c;return e("div",[e("el-form",{attrs:{model:t.form,"label-position":"top"}},[e("el-form-item",{attrs:{label:"Title"}},[e("el-input",{model:{value:t.form.title,callback:function(e){t.$set(t.form,"title",e)},expression:"form.title"}})],1),t._v(" "),e("el-form-item",{attrs:{label:"Description"}},[e("el-input",{attrs:{type:"textarea",rows:"5"},model:{value:t.form.description,callback:function(e){t.$set(t.form,"description",e)},expression:"form.description"}})],1),t._v(" "),e("el-form-item",{attrs:{label:"Keywords"}},[e("el-input",{attrs:{type:"textarea",rows:"3"},model:{value:t.form.keywords,callback:function(e){t.$set(t.form,"keywords",e)},expression:"form.keywords"}})],1)],1)],1)}),[],!1,null,null,null).exports},91999:(t,e,a)=>{a.r(e),a.d(e,{default:()=>n});const l={components:{Seo:a(18393).A},data:function(){return{articles:[],activeTab:"main",slug:"articles",page_id:null,seo:{title:"",description:"",keywords:""}}},computed:{},methods:{getPage:function(){var t=this;axios.get("/api/admin/page",{params:{slug:this.slug}}).then((function(e){t.page_id=e.data.id,t.seo=e.data.seo,console.log(e.data)}))},submitSeo:function(){axios.post("/api/admin/page/"+this.page_id+"/update",this.seo).then((function(t){console.log(t.data)}))},getArticles:function(){var t=this;axios.get("/api/admin/articles").then((function(e){t.articles=e.data}))},handleDelete:function(t){var e=this;axios.delete("/api/admin/article/"+t).then((function(a){var l=e.articles.findIndex((function(e){return e.id===t}));e.articles.splice(l,1)}))}},mounted:function(){this.getArticles(),this.getPage()}};const n=(0,a(14486).A)(l,(function(){var t=this,e=t._self._c;return e("section",[e("h1",[t._v("Статьи")]),t._v(" "),e("el-tabs",{attrs:{type:"card"},model:{value:t.activeTab,callback:function(e){t.activeTab=e},expression:"activeTab"}},[e("el-tab-pane",{attrs:{label:"Основная информация",name:"main"}},[e("div",{staticClass:"mb-3"},[e("router-link",{attrs:{to:"create"}},[e("el-button",{attrs:{type:"success",icon:"el-icon-plus"}},[t._v("Новая статья")])],1)],1),t._v(" "),e("data-tables",{attrs:{data:t.articles}},[e("el-table-column",{attrs:{type:"index",label:"№"}}),t._v(" "),e("el-table-column",{attrs:{label:"Заголовок",prop:"title",sortable:""}}),t._v(" "),e("el-table-column",{attrs:{label:"Дата",prop:"date",sortable:""}}),t._v(" "),e("el-table-column",{attrs:{label:"Действия"},scopedSlots:t._u([{key:"default",fn:function(a){return[e("router-link",{attrs:{to:"edit/"+a.row.id}},[e("el-button",{attrs:{size:"mini",type:"primary"}},[t._v("\n                        Редактировать\n                    ")])],1),t._v(" "),e("el-button",{attrs:{size:"mini",type:"danger"},on:{click:function(e){return t.handleDelete(a.row.id)}}},[t._v("Удалить ")])]}}])})],1)],1),t._v(" "),e("el-tab-pane",{attrs:{label:"Настройки и SEO",name:"config"}},[t.seo?e("Seo",{attrs:{form:t.seo}}):t._e(),t._v(" "),e("el-button",{attrs:{type:"success"},on:{click:function(e){return e.preventDefault(),t.submitSeo.apply(null,arguments)}}},[t._v("Сохранить")])],1)],1)],1)}),[],!1,null,null,null).exports}}]);
//# sourceMappingURL=999.a119f0.js.map