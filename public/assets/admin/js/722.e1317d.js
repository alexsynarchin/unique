/*! For license information please see 722.e1317d.js.LICENSE.txt */
"use strict";(self.webpackChunkunique=self.webpackChunkunique||[]).push([[722],{49334:(t,e,r)=>{function o(t){return o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},o(t)}function n(t,e){for(var r=0;r<e.length;r++){var o=e[r];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(t,a(o.key),o)}}function a(t){var e=function(t,e){if("object"!=o(t)||!t)return t;var r=t[Symbol.toPrimitive];if(void 0!==r){var n=r.call(t,e||"default");if("object"!=o(n))return n;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===e?String:Number)(t)}(t,"string");return"symbol"==o(e)?e:e+""}r.d(e,{I:()=>s});var s=function(){return t=function t(){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.errors={}},(e=[{key:"has",value:function(t){return this.errors.hasOwnProperty(t)}},{key:"any",value:function(){return Object.keys(this.errors).length>0}},{key:"get",value:function(t){if(this.errors[t])return this.errors[t][0]}},{key:"getFlash",value:function(t){if(this.errors[t])return this.errors[t]}},{key:"record",value:function(t){this.errors=t}},{key:"clear",value:function(t){t?this.has(t)&&delete this.errors[t]:this.errors={}}}])&&n(t.prototype,e),r&&n(t,r),Object.defineProperty(t,"prototype",{writable:!1}),t;var t,e,r}()},40722:(t,e,r)=>{r.r(e),r.d(e,{default:()=>m});var o=r(49334);const n={props:{saveMsg:{default:"Модератор добавлен"},form:{type:Object},formAction:{type:Object}},data:function(){return{showPasswordModal:!1,passwordForm:{password:"",password_confirmation:""},permissions:[],errors:new o.I}},methods:{changePassword:function(){var t=this;axios.post("/api/admin/user/"+this.form.id+"/change-password",this.passwordForm).then((function(e){t.$message({message:e.data,type:"success"}),t.showPasswordModal=!1,t.passwordForm.password="",t.passwordForm.password_confirmation=""})).catch((function(e){t.errors.record(e.response.data.errors)}))},getPermissions:function(){var t=this;axios.get("/api/admin/permissions").then((function(e){t.permissions=e.data}))},closeModal:function(t){this.$emit("close",t)},save:function(){var t=this;axios({method:this.formAction.method,url:this.formAction.url,data:this.form}).then((function(e){t.$message({message:t.saveMsg,type:"success"}),t.closeModal()})).catch((function(e){t.errors.record(e.response.data.errors)}))}},mounted:function(){this.getPermissions()}};var a=r(14486);const s=(0,a.A)(n,(function(){var t=this,e=t._self._c;return e("el-tabs",{attrs:{type:"card"}},[e("el-tab-pane",{attrs:{label:"Основная информация"}},[e("el-form",{ref:"form",attrs:{model:t.form}},[e("el-row",{attrs:{type:"flex",gutter:10}},[e("el-col",{attrs:{span:12}},[e("el-form-item",{attrs:{prop:"email",label:"E-mail",error:t.errors.get("email")}},[e("el-input",{attrs:{placeholder:"Электронная почта"},model:{value:t.form.email,callback:function(e){t.$set(t.form,"email",e)},expression:"form.email"}})],1)],1),t._v(" "),e("el-col",{attrs:{span:12}},[e("el-form-item",{attrs:{prop:"name",label:"Имя",error:t.errors.get("name")}},[e("el-input",{attrs:{placeholder:"Имя"},model:{value:t.form.name,callback:function(e){t.$set(t.form,"name",e)},expression:"form.name"}})],1)],1)],1),t._v(" "),e("el-row",{attrs:{type:"flex",gutter:10}},[e("el-col",{attrs:{span:12}},[e("el-form-item",{attrs:{prop:"surname",label:"Фамилия"}},[e("el-input",{attrs:{placeholder:"Фамилия"},model:{value:t.form.surname,callback:function(e){t.$set(t.form,"surname",e)},expression:"form.surname"}})],1)],1),t._v(" "),e("el-col",{attrs:{span:12}},[e("el-form-item",{attrs:{prop:"last_name",label:"Отчество"}},[e("el-input",{attrs:{placeholder:"Отчество"},model:{value:t.form.last_name,callback:function(e){t.$set(t.form,"last_name",e)},expression:"form.last_name"}})],1)],1)],1),t._v(" "),"post"===t.formAction.method?e("el-row",{attrs:{type:"flex",gutter:10}},[e("el-col",{attrs:{span:12}},[e("el-form-item",{attrs:{prop:"password",label:"Пароль",error:t.errors.get("password")}},[e("el-input",{attrs:{placeholder:"Введите пароль","show-password":""},model:{value:t.form.password,callback:function(e){t.$set(t.form,"password",e)},expression:"form.password"}})],1)],1),t._v(" "),e("el-col",{attrs:{span:12}},[e("el-form-item",{attrs:{prop:"password_confirmation",label:"Подтверждение пароля"}},[e("el-input",{attrs:{placeholder:"Повторите пароль","show-password":""},model:{value:t.form.password_confirmation,callback:function(e){t.$set(t.form,"password_confirmation",e)},expression:"form.password_confirmation"}})],1)],1)],1):e("el-row",{attrs:{type:"flex",gutter:10}},[e("el-col",{attrs:{span:12}},[e("el-button",{attrs:{icon:"el-icon-unlock",type:"primary"},on:{click:function(e){t.showPasswordModal=!0}}},[t._v("Сменить пароль")])],1)],1),t._v(" "),e("div",{staticClass:"text-center"},[e("el-button",{attrs:{type:"success"},on:{click:function(e){return e.preventDefault(),t.save.apply(null,arguments)}}},[t._v("Сохранить")]),t._v(" "),e("el-button",{attrs:{type:""},on:{click:function(e){return e.preventDefault(),t.closeModal.apply(null,arguments)}}},[t._v("Отменить")])],1)],1),t._v(" "),e("el-dialog",{attrs:{"append-to-body":"",visible:t.showPasswordModal,title:"Сменить пароль"},on:{"update:visible":function(e){t.showPasswordModal=e}}},[e("el-form",{attrs:{model:t.passwordForm,"label-position":"top"}},[e("div",{staticClass:"row"},[e("el-form-item",{staticClass:"col-md-6",attrs:{label:"Новый пароль",error:t.errors.get("password")}},[e("el-input",{attrs:{"show-password":""},model:{value:t.passwordForm.password,callback:function(e){t.$set(t.passwordForm,"password",e)},expression:"passwordForm.password"}})],1),t._v(" "),e("el-form-item",{staticClass:"col-md-6",attrs:{label:"Подтверждение пароля"}},[e("el-input",{attrs:{"show-password":""},model:{value:t.passwordForm.password_confirmation,callback:function(e){t.$set(t.passwordForm,"password_confirmation",e)},expression:"passwordForm.password_confirmation"}})],1)],1)]),t._v(" "),e("span",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[e("el-button",{on:{click:function(e){t.showPasswordModal=!1}}},[t._v("Отмена")]),t._v(" "),e("el-button",{attrs:{type:"success"},on:{click:t.changePassword}},[t._v("Сохранить")])],1)],1)],1),t._v(" "),e("el-tab-pane",{attrs:{label:"Права доступа"}},[e("el-checkbox-group",{on:{change:function(t){}},model:{value:t.form.permissions_arr,callback:function(e){t.$set(t.form,"permissions_arr",e)},expression:"form.permissions_arr"}},[e("div",{staticClass:"row"},t._l(t.permissions,(function(r){return"manage_permission"!==r.name?e("div",{staticClass:"col-md-6 mb-2"},[e("el-checkbox",{key:r.name,attrs:{label:r.name}},[t._v(t._s(t.$t("permissions."+r.name)))])],1):t._e()})),0)])],1)],1)}),[],!1,null,null,null).exports,i={components:{ModeratorForm:s},data:function(){return{formAction:{url:"/api/admin/moderators",method:"post"},form:{email:"",name:"",surname:"",last_name:"",password:"",password_confirmation:"",id:null,permissions_arr:[]}}},methods:{closeModal:function(t){this.$emit("close",t)}}};function l(t){return l="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},l(t)}function c(){c=function(){return e};var t,e={},r=Object.prototype,o=r.hasOwnProperty,n=Object.defineProperty||function(t,e,r){t[e]=r.value},a="function"==typeof Symbol?Symbol:{},s=a.iterator||"@@iterator",i=a.asyncIterator||"@@asyncIterator",u=a.toStringTag||"@@toStringTag";function f(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{f({},"")}catch(t){f=function(t,e,r){return t[e]=r}}function d(t,e,r,o){var a=e&&e.prototype instanceof b?e:b,s=Object.create(a.prototype),i=new $(o||[]);return n(s,"_invoke",{value:P(t,r,i)}),s}function m(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}e.wrap=d;var p="suspendedStart",h="suspendedYield",v="executing",y="completed",w={};function b(){}function g(){}function _(){}var x={};f(x,s,(function(){return this}));var k=Object.getPrototypeOf,M=k&&k(k(A([])));M&&M!==r&&o.call(M,s)&&(x=M);var L=_.prototype=b.prototype=Object.create(x);function E(t){["next","throw","return"].forEach((function(e){f(t,e,(function(t){return this._invoke(e,t)}))}))}function S(t,e){function r(n,a,s,i){var c=m(t[n],t,a);if("throw"!==c.type){var u=c.arg,f=u.value;return f&&"object"==l(f)&&o.call(f,"__await")?e.resolve(f.__await).then((function(t){r("next",t,s,i)}),(function(t){r("throw",t,s,i)})):e.resolve(f).then((function(t){u.value=t,s(u)}),(function(t){return r("throw",t,s,i)}))}i(c.arg)}var a;n(this,"_invoke",{value:function(t,o){function n(){return new e((function(e,n){r(t,o,e,n)}))}return a=a?a.then(n,n):n()}})}function P(e,r,o){var n=p;return function(a,s){if(n===v)throw Error("Generator is already running");if(n===y){if("throw"===a)throw s;return{value:t,done:!0}}for(o.method=a,o.arg=s;;){var i=o.delegate;if(i){var l=O(i,o);if(l){if(l===w)continue;return l}}if("next"===o.method)o.sent=o._sent=o.arg;else if("throw"===o.method){if(n===p)throw n=y,o.arg;o.dispatchException(o.arg)}else"return"===o.method&&o.abrupt("return",o.arg);n=v;var c=m(e,r,o);if("normal"===c.type){if(n=o.done?y:h,c.arg===w)continue;return{value:c.arg,done:o.done}}"throw"===c.type&&(n=y,o.method="throw",o.arg=c.arg)}}}function O(e,r){var o=r.method,n=e.iterator[o];if(n===t)return r.delegate=null,"throw"===o&&e.iterator.return&&(r.method="return",r.arg=t,O(e,r),"throw"===r.method)||"return"!==o&&(r.method="throw",r.arg=new TypeError("The iterator does not provide a '"+o+"' method")),w;var a=m(n,e.iterator,r.arg);if("throw"===a.type)return r.method="throw",r.arg=a.arg,r.delegate=null,w;var s=a.arg;return s?s.done?(r[e.resultName]=s.value,r.next=e.nextLoc,"return"!==r.method&&(r.method="next",r.arg=t),r.delegate=null,w):s:(r.method="throw",r.arg=new TypeError("iterator result is not an object"),r.delegate=null,w)}function j(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function F(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function $(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(j,this),this.reset(!0)}function A(e){if(e||""===e){var r=e[s];if(r)return r.call(e);if("function"==typeof e.next)return e;if(!isNaN(e.length)){var n=-1,a=function r(){for(;++n<e.length;)if(o.call(e,n))return r.value=e[n],r.done=!1,r;return r.value=t,r.done=!0,r};return a.next=a}}throw new TypeError(l(e)+" is not iterable")}return g.prototype=_,n(L,"constructor",{value:_,configurable:!0}),n(_,"constructor",{value:g,configurable:!0}),g.displayName=f(_,u,"GeneratorFunction"),e.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===g||"GeneratorFunction"===(e.displayName||e.name))},e.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,_):(t.__proto__=_,f(t,u,"GeneratorFunction")),t.prototype=Object.create(L),t},e.awrap=function(t){return{__await:t}},E(S.prototype),f(S.prototype,i,(function(){return this})),e.AsyncIterator=S,e.async=function(t,r,o,n,a){void 0===a&&(a=Promise);var s=new S(d(t,r,o,n),a);return e.isGeneratorFunction(r)?s:s.next().then((function(t){return t.done?t.value:s.next()}))},E(L),f(L,u,"Generator"),f(L,s,(function(){return this})),f(L,"toString",(function(){return"[object Generator]"})),e.keys=function(t){var e=Object(t),r=[];for(var o in e)r.push(o);return r.reverse(),function t(){for(;r.length;){var o=r.pop();if(o in e)return t.value=o,t.done=!1,t}return t.done=!0,t}},e.values=A,$.prototype={constructor:$,reset:function(e){if(this.prev=0,this.next=0,this.sent=this._sent=t,this.done=!1,this.delegate=null,this.method="next",this.arg=t,this.tryEntries.forEach(F),!e)for(var r in this)"t"===r.charAt(0)&&o.call(this,r)&&!isNaN(+r.slice(1))&&(this[r]=t)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(e){if(this.done)throw e;var r=this;function n(o,n){return i.type="throw",i.arg=e,r.next=o,n&&(r.method="next",r.arg=t),!!n}for(var a=this.tryEntries.length-1;a>=0;--a){var s=this.tryEntries[a],i=s.completion;if("root"===s.tryLoc)return n("end");if(s.tryLoc<=this.prev){var l=o.call(s,"catchLoc"),c=o.call(s,"finallyLoc");if(l&&c){if(this.prev<s.catchLoc)return n(s.catchLoc,!0);if(this.prev<s.finallyLoc)return n(s.finallyLoc)}else if(l){if(this.prev<s.catchLoc)return n(s.catchLoc,!0)}else{if(!c)throw Error("try statement without catch or finally");if(this.prev<s.finallyLoc)return n(s.finallyLoc)}}}},abrupt:function(t,e){for(var r=this.tryEntries.length-1;r>=0;--r){var n=this.tryEntries[r];if(n.tryLoc<=this.prev&&o.call(n,"finallyLoc")&&this.prev<n.finallyLoc){var a=n;break}}a&&("break"===t||"continue"===t)&&a.tryLoc<=e&&e<=a.finallyLoc&&(a=null);var s=a?a.completion:{};return s.type=t,s.arg=e,a?(this.method="next",this.next=a.finallyLoc,w):this.complete(s)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),w},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),F(r),w}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var o=r.completion;if("throw"===o.type){var n=o.arg;F(r)}return n}}throw Error("illegal catch attempt")},delegateYield:function(e,r,o){return this.delegate={iterator:A(e),resultName:r,nextLoc:o},"next"===this.method&&(this.arg=t),w}},e}function u(t,e,r,o,n,a,s){try{var i=t[a](s),l=i.value}catch(t){return void r(t)}i.done?e(l):Promise.resolve(l).then(o,n)}const f={components:{ModeratorForm:s},props:["id"],data:function(){return{loaded:!1,form:{},formAction:{url:"/api/admin/moderators/"+this.id,method:"put"}}},methods:{closeModal:function(t){this.$emit("close",t)},getFormData:function(){var t=this;return this.$root.isLoading=!0,axios.get("/api/admin/moderators/"+this.id).then((function(e){t.form=e.data,t.loaded=!0,t.$root.isLoading=!1}))}},mounted:function(){var t,e=this;return(t=c().mark((function t(){return c().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,e.getFormData();case 2:case"end":return t.stop()}}),t)})),function(){var e=this,r=arguments;return new Promise((function(o,n){var a=t.apply(e,r);function s(t){u(a,o,n,s,i,"next",t)}function i(t){u(a,o,n,s,i,"throw",t)}s(void 0)}))})()}};const d={components:{create:(0,a.A)(i,(function(){var t=this;return(0,t._self._c)("moderator-form",{attrs:{form:t.form,formAction:t.formAction,closeMsg:"Пользователь добавлен"},on:{close:t.closeModal}})}),[],!1,null,null,null).exports,edit:(0,a.A)(f,(function(){var t=this,e=t._self._c;return e("section",[t.loaded?e("moderator-form",{attrs:{"save-msg":"Пользователь обновлен",form:t.form,formAction:t.formAction},on:{close:t.closeModal}}):t._e()],1)}),[],!1,null,null,null).exports},computed:{moderatorModalTitle:function(){return"create"===this.moderatorModalStatus?"Новый модератор":"edit"===this.moderatorModalStatus?"Обновление данных модератора":void 0}},data:function(){return{id:null,moderatorModal:!1,moderatorModalStatus:"",moderators:[],filters:[{prop:["name","surname","last_name"],value:""}]}},methods:{handleDelete:function(t){var e=this;this.$confirm("Вы уверены что хотите удалить пользователя","Удаление пользователя",{confirmButtonText:"Удалить",cancelButtonText:"Отмена",type:"warning"}).then((function(){axios.delete("/api/admin/moderators/"+t.id).then((function(t){var r=e.moderators.findIndex((function(e){return e.id===t.data.id}));e.moderators.splice(r,1),e.$message({type:"success",message:"Пользователь удален"})}))})).catch((function(){}))},moderatorModalOpen:function(t){this.moderatorModalStatus=t,this.moderatorModal=!0},getModerators:function(){var t=this;axios.get("/api/admin/moderators").then((function(e){t.moderators=e.data}))},closeModal:function(t){this.moderatorModal=!1,this.id=null,this.getModerators()},handleEdit:function(t){this.id=t.id,this.moderatorModalStatus="edit",this.moderatorModal=!0},updateModerator:function(t){}},mounted:function(){this.getModerators()}};const m=(0,a.A)(d,(function(){var t=this,e=t._self._c;return e("section",{staticClass:"page"},[e("div",{staticClass:"page-heading d-flex align-items-center justify-content-between mb-3"},[e("h1",{staticClass:"page-title mb-0"},[t._v("Модераторы")]),t._v(" "),e("el-button",{attrs:{type:"success",icon:"el-icon-plus"},on:{click:function(e){return t.moderatorModalOpen("create")}}},[t._v("Добавить")])],1),t._v(" "),e("el-row",{staticClass:"mb-3",attrs:{type:"flex"}},[e("el-col",{attrs:{span:8}},[e("el-input",{attrs:{size:"large",width:"100%",placeholder:"Поиск: Имя, Фамилия или Отчество"},model:{value:t.filters[0].value,callback:function(e){t.$set(t.filters[0],"value",e)},expression:"filters[0].value"}})],1)],1),t._v(" "),e("data-tables",{attrs:{data:t.moderators,filters:t.filters}},[e("el-table-column",{attrs:{type:"index",label:"№"}}),t._v(" "),e("el-table-column",{attrs:{label:"Фамилия",prop:"surname",sortable:""}}),t._v(" "),e("el-table-column",{attrs:{label:"Имя",prop:"name",sortable:""}}),t._v(" "),e("el-table-column",{attrs:{label:"Отчество",prop:"last_name",sortable:""}}),t._v(" "),e("el-table-column",{attrs:{label:"E-mail",prop:"email",sortable:""}}),t._v(" "),e("el-table-column",{attrs:{label:"Действия"},scopedSlots:t._u([{key:"default",fn:function(r){return[e("el-button",{attrs:{size:"mini",type:"primary"},on:{click:function(e){return t.handleEdit(r.row)}}},[t._v("Редактировать")]),t._v(" "),1!==r.row.id?e("el-button",{attrs:{size:"mini",type:"danger"},on:{click:function(e){return t.handleDelete(r.row)}}},[t._v("\n                    Удалить\n                ")]):t._e()]}}])})],1),t._v(" "),e("el-dialog",{attrs:{visible:t.moderatorModal,width:"60%",title:t.moderatorModalTitle},on:{"update:visible":function(e){t.moderatorModal=e}}},[t.moderatorModal&&"create"===t.moderatorModalStatus?e("create",{on:{close:t.closeModal}}):t._e(),t._v(" "),t.moderatorModal&&"edit"===t.moderatorModalStatus?e("edit",{attrs:{id:t.id},on:{close:t.closeModal}}):t._e()],1)],1)}),[],!1,null,null,null).exports}}]);
//# sourceMappingURL=722.e1317d.js.map