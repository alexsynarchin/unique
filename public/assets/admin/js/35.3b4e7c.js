/*! For license information please see 35.3b4e7c.js.LICENSE.txt */
(self.webpackChunkunique=self.webpackChunkunique||[]).push([[35],{49334:(t,e,r)=>{"use strict";function i(t){return i="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},i(t)}function n(t,e){for(var r=0;r<e.length;r++){var i=e[r];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,s(i.key),i)}}function s(t){var e=function(t,e){if("object"!=i(t)||!t)return t;var r=t[Symbol.toPrimitive];if(void 0!==r){var n=r.call(t,e||"default");if("object"!=i(n))return n;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===e?String:Number)(t)}(t,"string");return"symbol"==i(e)?e:e+""}r.d(e,{I:()=>o});var o=function(){return t=function t(){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.errors={}},(e=[{key:"has",value:function(t){return this.errors.hasOwnProperty(t)}},{key:"any",value:function(){return Object.keys(this.errors).length>0}},{key:"get",value:function(t){if(this.errors[t])return this.errors[t][0]}},{key:"getFlash",value:function(t){if(this.errors[t])return this.errors[t]}},{key:"record",value:function(t){this.errors=t}},{key:"clear",value:function(t){t?this.has(t)&&delete this.errors[t]:this.errors={}}}])&&n(t.prototype,e),r&&n(t,r),Object.defineProperty(t,"prototype",{writable:!1}),t;var t,e,r}()},9035:(t,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>g});const i={props:{selected:{type:Array}},data:function(){return{list:[]}},methods:{getSystemsList:function(){var t=this;axios.get("/api/check-systems").then((function(e){t.list=e.data}))}},mounted:function(){this.getSystemsList()}};var n=r(14486);const s=(0,n.A)(i,(function(){var t=this,e=t._self._c;return e("section",{staticClass:"report-systems-list"},[e("h3",{staticClass:"report-systems-list__title"},[t._v("\n        Системы проверки:\n    ")]),t._v(" "),e("ul",{staticClass:"report-systems-list__list"},t._l(t.list,(function(r,i){return-1!==t.selected.indexOf(r.id)?e("li",{staticClass:"report-systems-list__item"},[e("section",{staticClass:"report-systems-list-item"},[t._v("\n                "+t._s(r.title)+"\n            ")])]):t._e()})),0)])}),[],!1,null,null,null).exports;var o=r(85090),a=r.n(o),l=r(49334);const c={props:{report:{}},data:function(){return{dialogVisible:!1,fileList:[],form:{unique_percent:0,report_file:""},errors:new l.I}},methods:{handleClose:function(){this.dialogVisible=!1,this.errors.clear("report_file")},openModal:function(){this.dialogVisible=!0},sendReport:function(){var t=this,e=new FormData;e.append("report_file",this.form.report_file),e.append("unique_percent",this.form.unique_percent);axios.post("/api/admin/report/"+this.report.id+"/send",e,{headers:{"content-type":"multipart/form-data"}}).then((function(e){console.log(e.data),t.handleClose(),t.$emit("refresh-data")})).catch((function(e){t.errors.record(e.response.data.errors)}))},handleFileChange:function(t,e){this.form.report_file=t.raw},handleFileRemove:function(t,e){this.form.report_file=""},clearFiles:function(t,e){console.log(t),console.log(this.$refs.upload)}},mounted:function(){this.report.result&&(this.form.unique_percent=this.report.data.unique)}};const u=(0,n.A)(c,(function(){var t=this,e=t._self._c;return e("el-dialog",{attrs:{title:"Отправить отчет",visible:t.dialogVisible,width:"30%","before-close":t.handleClose},on:{"update:visible":function(e){t.dialogVisible=e}}},[e("el-form",{attrs:{model:t.form,"label-position":"top"}},[e("el-form-item",{attrs:{label:"Процент уникальности",prop:"unique_percent"}},[e("el-input-number",{attrs:{min:0,max:100},model:{value:t.form.unique_percent,callback:function(e){t.$set(t.form,"unique_percent",e)},expression:"form.unique_percent"}})],1),t._v(" "),e("el-form-item",{attrs:{error:t.errors.get("report_file")}},[e("el-upload",{ref:"upload",staticClass:"upload-demo",attrs:{action:"","file-list":t.fileList,limit:1,"on-change":t.handleFileChange,"on-remove":t.handleFileRemove,"on-exceed":t.clearFiles,"auto-upload":!1}},[t.form.report_file?t._e():e("el-button",{attrs:{slot:"trigger",size:"small",type:"primary"},slot:"trigger"},[t._v("Прикрепить файл отчета")]),t._v(" "),e("div",{staticClass:"el-upload__tip",attrs:{slot:"tip"},slot:"tip"})],1)],1)],1),t._v(" "),e("span",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[e("el-button",{on:{click:function(e){t.dialogVisible=!1}}},[t._v("Отмена")]),t._v(" "),e("el-button",{attrs:{type:"primary"},on:{click:t.sendReport}},[t._v("Отправить")])],1)],1)}),[],!1,null,null,null).exports,p={components:{ProgressBar:a(),ReportSend:u},computed:{checkUniqueTypeString:function(){return this.report.check_system.api_id?"Автоматическая проверка":"Ручная проверка"},reportBtnString:function(){return this.report.result?"Отправить отчет заново":"Отправить отчет"}},data:function(){return{check_system:{},increasing_pct:0,decreasing_pct:100}},props:{report:{type:Object},check_unique:{type:Object}},methods:{refreshData:function(){this.$emit("refresh-data")},downloadPdf:function(){var t=this;this.$root.isLoading=!0,axios.post("/api/report/"+this.report.id+"/download").then((function(e){console.log(e.data),t.$root.isLoading=!1;var r=document.createElement("a");r.href=e.data,r.download="report",r.click()})).catch((function(t){console.log(t)}))}},mounted:function(){var t=this;this.check_system=this.report.check_system,this.report.result||setInterval((function(){t.is_paused||(t.random_pct=Math.ceil(100*Math.random()),t.increasing_pct=Math.min(t.increasing_pct+2,100),t.decreasing_pct=Math.max(t.decreasing_pct-2,0))}),3500)}};const f=(0,n.A)(p,(function(){var t=this,e=t._self._c;return e("section",{staticClass:"report-item"},[e("h3",{staticClass:"report-item__title"},[t._v("\n        Проверка "+t._s(t.report.formatted_date)+"\n    ")]),t._v(" "),t.report.error_code?e("el-alert",{staticClass:"mb-4",attrs:{title:t.report.error,description:"Необходимо отправить отчет в ручном режиме",type:"error","show-icon":""}}):t._e(),t._v(" "),e("div",{staticClass:"report-item__content"},[e("div",{staticClass:"report-item-system"},[e("h4",{staticClass:"report-item-system__title"},[t._v("\n                "+t._s(t.check_system.title)+"\n            ")]),t._v(" "),e("figure",{staticClass:"report-item-system__logo"},[e("img",{attrs:{src:t.check_system.logo}})])]),t._v(" "),e("section",{staticClass:"report-item__center"},[e("div",{staticClass:"d-flex flex-wrap justify-content-between align-items-center"},[e("div",[t.report.result?e("el-tag",{attrs:{type:"success"}},[t._v("\n                        Отчет сформирован\n                    ")]):e("el-tag",{attrs:{type:"warning"}},[t._v("\n                        Отчет не сформирован\n                    ")]),t._v(" "),e("el-tag",{attrs:{type:"primary"}},[t._v(t._s(t.checkUniqueTypeString))])],1),t._v(" "),!t.report.check_system.api_id||t.report.error_code?e("el-button",{attrs:{type:"primary"},on:{click:function(e){return e.preventDefault(),t.$refs.reportSend.openModal()}}},[t._v(t._s(t.reportBtnString))]):t._e()],1),t._v(" "),t.report.result?e("div",[t.report.result?e("div",{staticClass:"report-progress-bar"},[e("progress-bar",{attrs:{"bg-color":"#E3E5ED","bar-color":"#366AF3","bar-border-radius":30,size:"15",val:t.report.data.unique}}),t._v(" "),e("div",{staticClass:"report-progress-bar__text"},[t._v("\n                            Процент уникальности:\n                            "),e("span",{staticClass:"report-progress-bar__precent"},[t._v(t._s(t.report.data.unique+"%"))])])],1):t._e()]):t._e()]),t._v(" "),e("section",{staticClass:"report-item__right"},[e("ul",{staticClass:"report-text-params"},[e("li",{staticClass:"report-text-params__item"},[e("label",{staticClass:"report-text-params__label"},[t._v("\n                        Номер отчета:\n                    ")]),t._v(" "),e("span",{staticClass:"report-text-params__value"},[t._v("\n                        "+t._s(t.check_unique.id)+"\n                    ")])]),t._v(" "),e("li",{staticClass:"report-text-params__item"},[e("label",{staticClass:"report-text-params__label"},[t._v("\n                        Страниц:\n                    ")]),t._v(" "),e("span",{staticClass:"report-text-params__value"},[t._v("\n                        "+t._s(t.report.params.pages)+"\n                    ")])]),t._v(" "),e("li",{staticClass:"report-text-params__item"},[e("label",{staticClass:"report-text-params__label"},[t._v("\n                        Слов:\n                    ")]),t._v(" "),e("span",{staticClass:"report-text-params__value"},[t._v("\n                         "+t._s(t.report.params.wordsCount)+"\n                    ")])]),t._v(" "),e("li",{staticClass:"report-text-params__item"},[e("label",{staticClass:"report-text-params__label"},[t._v("\n                        Символов:\n                    ")]),t._v(" "),e("span",{staticClass:"report-text-params__value"},[t._v("\n                        "+t._s(t.report.params.symbols_count)+"\n                    ")])]),t._v(" "),e("li",{staticClass:"report-text-params__item"},[e("label",{staticClass:"report-text-params__label"},[t._v("\n                        Тип документа:\n                    ")]),t._v(" "),e("span",{staticClass:"report-text-params__value"},[t._v("\n                            "+t._s(t.check_unique.type)+"\n                    ")])])]),t._v(" "),e("div",{staticClass:"report-item-bnts"},[t.report.result?e("el-button",{attrs:{type:"primary"},on:{click:function(e){return e.preventDefault(),t.downloadPdf.apply(null,arguments)}}},[t._v("\n                    Скачать отчет\n                ")]):t._e()],1)])]),t._v(" "),e("report-send",{ref:"reportSend",attrs:{report:t.report},on:{"refresh-data":t.refreshData}})],1)}),[],!1,null,null,null).exports;const d={props:{report:{type:Object}},data:function(){return{showDetail:!1}},methods:{handleDetail:function(){this.showDetail=!this.showDetail},selectUrl:function(t){},copyUrl:function(t,e){var r=document.querySelector("#report_item_link_"+t);r.setAttribute("type","text"),r.select(),document.execCommand("copy"),r.setAttribute("type","hidden")}}};function h(t){return h="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},h(t)}function _(){_=function(){return e};var t,e={},r=Object.prototype,i=r.hasOwnProperty,n=Object.defineProperty||function(t,e,r){t[e]=r.value},s="function"==typeof Symbol?Symbol:{},o=s.iterator||"@@iterator",a=s.asyncIterator||"@@asyncIterator",l=s.toStringTag||"@@toStringTag";function c(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{c({},"")}catch(t){c=function(t,e,r){return t[e]=r}}function u(t,e,r,i){var s=e&&e.prototype instanceof g?e:g,o=Object.create(s.prototype),a=new z(i||[]);return n(o,"_invoke",{value:q(t,r,a)}),o}function p(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}e.wrap=u;var f="suspendedStart",d="suspendedYield",v="executing",m="completed",y={};function g(){}function x(){}function b(){}var w={};c(w,o,(function(){return this}));var k=Object.getPrototypeOf,C=k&&k(k(F([])));C&&C!==r&&i.call(C,o)&&(w=C);var S=b.prototype=g.prototype=Object.create(w);function L(t){["next","throw","return"].forEach((function(e){c(t,e,(function(t){return this._invoke(e,t)}))}))}function P(t,e){function r(n,s,o,a){var l=p(t[n],t,s);if("throw"!==l.type){var c=l.arg,u=c.value;return u&&"object"==h(u)&&i.call(u,"__await")?e.resolve(u.__await).then((function(t){r("next",t,o,a)}),(function(t){r("throw",t,o,a)})):e.resolve(u).then((function(t){c.value=t,o(c)}),(function(t){return r("throw",t,o,a)}))}a(l.arg)}var s;n(this,"_invoke",{value:function(t,i){function n(){return new e((function(e,n){r(t,i,e,n)}))}return s=s?s.then(n,n):n()}})}function q(e,r,i){var n=f;return function(s,o){if(n===v)throw Error("Generator is already running");if(n===m){if("throw"===s)throw o;return{value:t,done:!0}}for(i.method=s,i.arg=o;;){var a=i.delegate;if(a){var l=E(a,i);if(l){if(l===y)continue;return l}}if("next"===i.method)i.sent=i._sent=i.arg;else if("throw"===i.method){if(n===f)throw n=m,i.arg;i.dispatchException(i.arg)}else"return"===i.method&&i.abrupt("return",i.arg);n=v;var c=p(e,r,i);if("normal"===c.type){if(n=i.done?m:d,c.arg===y)continue;return{value:c.arg,done:i.done}}"throw"===c.type&&(n=m,i.method="throw",i.arg=c.arg)}}}function E(e,r){var i=r.method,n=e.iterator[i];if(n===t)return r.delegate=null,"throw"===i&&e.iterator.return&&(r.method="return",r.arg=t,E(e,r),"throw"===r.method)||"return"!==i&&(r.method="throw",r.arg=new TypeError("The iterator does not provide a '"+i+"' method")),y;var s=p(n,e.iterator,r.arg);if("throw"===s.type)return r.method="throw",r.arg=s.arg,r.delegate=null,y;var o=s.arg;return o?o.done?(r[e.resultName]=o.value,r.next=e.nextLoc,"return"!==r.method&&(r.method="next",r.arg=t),r.delegate=null,y):o:(r.method="throw",r.arg=new TypeError("iterator result is not an object"),r.delegate=null,y)}function j(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function O(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function z(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(j,this),this.reset(!0)}function F(e){if(e||""===e){var r=e[o];if(r)return r.call(e);if("function"==typeof e.next)return e;if(!isNaN(e.length)){var n=-1,s=function r(){for(;++n<e.length;)if(i.call(e,n))return r.value=e[n],r.done=!1,r;return r.value=t,r.done=!0,r};return s.next=s}}throw new TypeError(h(e)+" is not iterable")}return x.prototype=b,n(S,"constructor",{value:b,configurable:!0}),n(b,"constructor",{value:x,configurable:!0}),x.displayName=c(b,l,"GeneratorFunction"),e.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===x||"GeneratorFunction"===(e.displayName||e.name))},e.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,b):(t.__proto__=b,c(t,l,"GeneratorFunction")),t.prototype=Object.create(S),t},e.awrap=function(t){return{__await:t}},L(P.prototype),c(P.prototype,a,(function(){return this})),e.AsyncIterator=P,e.async=function(t,r,i,n,s){void 0===s&&(s=Promise);var o=new P(u(t,r,i,n),s);return e.isGeneratorFunction(r)?o:o.next().then((function(t){return t.done?t.value:o.next()}))},L(S),c(S,l,"Generator"),c(S,o,(function(){return this})),c(S,"toString",(function(){return"[object Generator]"})),e.keys=function(t){var e=Object(t),r=[];for(var i in e)r.push(i);return r.reverse(),function t(){for(;r.length;){var i=r.pop();if(i in e)return t.value=i,t.done=!1,t}return t.done=!0,t}},e.values=F,z.prototype={constructor:z,reset:function(e){if(this.prev=0,this.next=0,this.sent=this._sent=t,this.done=!1,this.delegate=null,this.method="next",this.arg=t,this.tryEntries.forEach(O),!e)for(var r in this)"t"===r.charAt(0)&&i.call(this,r)&&!isNaN(+r.slice(1))&&(this[r]=t)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(e){if(this.done)throw e;var r=this;function n(i,n){return a.type="throw",a.arg=e,r.next=i,n&&(r.method="next",r.arg=t),!!n}for(var s=this.tryEntries.length-1;s>=0;--s){var o=this.tryEntries[s],a=o.completion;if("root"===o.tryLoc)return n("end");if(o.tryLoc<=this.prev){var l=i.call(o,"catchLoc"),c=i.call(o,"finallyLoc");if(l&&c){if(this.prev<o.catchLoc)return n(o.catchLoc,!0);if(this.prev<o.finallyLoc)return n(o.finallyLoc)}else if(l){if(this.prev<o.catchLoc)return n(o.catchLoc,!0)}else{if(!c)throw Error("try statement without catch or finally");if(this.prev<o.finallyLoc)return n(o.finallyLoc)}}}},abrupt:function(t,e){for(var r=this.tryEntries.length-1;r>=0;--r){var n=this.tryEntries[r];if(n.tryLoc<=this.prev&&i.call(n,"finallyLoc")&&this.prev<n.finallyLoc){var s=n;break}}s&&("break"===t||"continue"===t)&&s.tryLoc<=e&&e<=s.finallyLoc&&(s=null);var o=s?s.completion:{};return o.type=t,o.arg=e,s?(this.method="next",this.next=s.finallyLoc,y):this.complete(o)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),y},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),O(r),y}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var i=r.completion;if("throw"===i.type){var n=i.arg;O(r)}return n}}throw Error("illegal catch attempt")},delegateYield:function(e,r,i){return this.delegate={iterator:F(e),resultName:r,nextLoc:i},"next"===this.method&&(this.arg=t),y}},e}function v(t,e,r,i,n,s,o){try{var a=t[s](o),l=a.value}catch(t){return void r(t)}a.done?e(l):Promise.resolve(l).then(i,n)}const m={props:{check_unique:{},id:{}},components:{ReportItem:f,ReportDetail:(0,n.A)(d,(function(){var t=this,e=t._self._c;return e("section",{staticClass:"report-item-detail"},[e("div",{staticClass:"report-item-detail__heading"},[e("h3",{staticClass:"report-item-detail__title"},[t._v("\n            Заимствования\n        ")]),t._v(" "),t.showDetail?e("span",{staticClass:"report-item-detail__control",on:{click:t.handleDetail}},[t._v("\n            Свернуть\n             "),e("svg",{staticClass:"report-item-detail__icon",attrs:{viewBox:"0 0 10 10"}},[e("use",{attrs:{"xlink:href":"assets/site/images/sprites.svg?ver=17#sprite-arrow-dig-top"}})])]):e("span",{staticClass:"report-item-detail__control",on:{click:t.handleDetail}},[t._v("\n            Развернуть\n             "),e("svg",{staticClass:"report-item-detail__icon",attrs:{viewBox:"0 0 10 10"}},[e("use",{attrs:{"xlink:href":"assets/site/images/sprites.svg?ver=17#sprite-arrow-dig-bottom"}})])])]),t._v(" "),e("section",{staticClass:"report-item-detail__content report-item-detail-content",class:{"report-item-detail-content--open":t.showDetail}},[e("p",{staticClass:"report-item-detail-content__descr"},[t._v("\n            Нажмите на ссылку для подсвечивания заимствованного текста\n        ")]),t._v(" "),e("ul",{staticClass:"report-item-links"},t._l(t.report.data.urls,(function(r,i){return e("li",{staticClass:"report-item-links__item"},[e("section",{staticClass:"report-item-links__text",on:{click:function(e){return e.preventDefault(),t.selectUrl(r)}}},[e("span",{staticClass:"report-item-links__percent"},[t._v("\n                        "+t._s(r.plagiat+"%")+"\n                    ")]),t._v(" "),e("span",{staticClass:"report-item-links__url"},[t._v("\n                        "+t._s(r.url)+"\n                        "),e("input",{attrs:{type:"hidden",id:"report_item_link_"+i},domProps:{value:r.url}})])]),t._v(" "),e("figure",{directives:[{name:"title",rawName:"v-title",value:"Скопировать ссылку",expression:"'Скопировать ссылку'"}],staticClass:"report-item-links__icon",on:{click:function(e){return e.preventDefault(),t.copyUrl(i,r.url)}}},[e("svg",{attrs:{viewBox:"0 0 18 22"}},[e("use",{attrs:{"xlink:href":"/assets/site/images/sprites.svg?ver=17#sprite-copy"}})])])])})),0),t._v(" "),e("section",{staticClass:"report--item-detail-text"},[t._v("\n            "+t._s(t.report.data.clear_text)+"\n        ")])])])}),[],!1,null,null,null).exports},data:function(){return{loaded:!1,report:{}}},methods:{getReport:function(){var t,e=this;return(t=_().mark((function t(){return _().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,axios.get("/api/report/"+e.id+"/show").then((function(t){e.report=t.data,e.loaded=!0,e.$root.isLoading=!1}));case 2:case"end":return t.stop()}}),t)})),function(){var e=this,r=arguments;return new Promise((function(i,n){var s=t.apply(e,r);function o(t){v(s,i,n,o,a,"next",t)}function a(t){v(s,i,n,o,a,"throw",t)}o(void 0)}))})()}},mounted:function(){this.$root.isLoading=!0,this.getReport()}};const y={components:{SystemsList:s,Report:(0,n.A)(m,(function(){var t=this,e=t._self._c;return e("section",{staticClass:"mb-4"},[t.loaded?e("report-item",{attrs:{report:t.report,check_unique:t.check_unique},on:{"refresh-data":t.getReport}}):t._e(),t._v(" "),t.report.result&&t.report.check_system.api_id?e("report-detail",{attrs:{report:t.report}}):t._e()],1)}),[],!1,null,null,null).exports},props:{id:{type:String}},data:function(){return{loaded:!1,selectedSystems:[],check_unique:{}}},methods:{getCheckUnique:function(){var t=this;axios.get("/api/check-unique/"+this.id+"/show").then((function(e){t.check_unique=e.data,t.loaded=!0,t.$root.isLoading=!1,t.check_unique.reports.forEach((function(e){t.selectedSystems.push(e.system_id)}))}))},setViewed:function(){axios.get("/api/admin/check-unique/"+this.id+"/show")}},mounted:function(){this.$route.meta.title=" Заявка №"+this.$route.params.id,this.$root.isLoading=!0,this.getCheckUnique(),this.setViewed()}};const g=(0,n.A)(y,(function(){var t=this,e=t._self._c;return e("el-card",{staticClass:"box-card"},[e("div",{staticClass:"clearfix",attrs:{slot:"header"},slot:"header"},[e("h5",[t._v("Заявка №"+t._s(t.id))])]),t._v(" "),e("div",{staticClass:"row mb-3"},[e("div",{staticClass:"col-md-6"},[e("label",[t._v("\n                E-mail:\n            ")]),t._v(" "),e("span",[t._v("\n                    "+t._s(t.check_unique.email)+"\n                ")])])]),t._v(" "),t.check_unique.filename?e("div",{staticClass:"mb-2"},[e("label",[t._v("Имя файла:")]),t._v(" "),e("span",[t._v(t._s(t.check_unique.filename))])]):t._e(),t._v(" "),e("label",[t._v("Текст:")]),t._v(" "),t.check_unique.filename?e("el-link",{attrs:{href:t.check_unique.file_link,icon:"el-icon-document",download:""}},[t._v("Скачать файл")]):e("div",{staticClass:"page-block mb-3"},[t._v("\n        "+t._s(t.check_unique.plainText)+"\n    ")]),t._v(" "),e("systems-list",{attrs:{selected:t.selectedSystems}}),t._v(" "),t._l(t.check_unique.reports,(function(r,i){return t.loaded?e("report",{key:r.id,attrs:{id:r.id,check_unique:t.check_unique}}):t._e()}))],2)}),[],!1,null,null,null).exports},85090:function(t){var e;e=function(){return function(t){var e={};function r(i){if(e[i])return e[i].exports;var n=e[i]={i,l:!1,exports:{}};return t[i].call(n.exports,n,n.exports,r),n.l=!0,n.exports}return r.m=t,r.c=e,r.d=function(t,e,i){r.o(t,e)||Object.defineProperty(t,e,{configurable:!1,enumerable:!0,get:i})},r.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return r.d(e,"a",e),e},r.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},r.p="",r(r.s=0)}([function(t,e,r){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.VueSimpleProgress=void 0;var i,n=r(1),s=(i=n)&&i.__esModule?i:{default:i};"undefined"!=typeof window&&window.Vue&&Vue.component("vue-simple-progress",s.default),e.VueSimpleProgress=s.default,e.default=s.default},function(t,e,r){var i=r(2)(r(3),r(4),null,null);t.exports=i.exports},function(t,e){t.exports=function(t,e,r,i){var n,s=t=t||{},o=typeof t.default;"object"!==o&&"function"!==o||(n=t,s=t.default);var a="function"==typeof s?s.options:s;if(e&&(a.render=e.render,a.staticRenderFns=e.staticRenderFns),r&&(a._scopeId=r),i){var l=Object.create(a.computed||null);Object.keys(i).forEach((function(t){var e=i[t];l[t]=function(){return e}})),a.computed=l}return{esModule:n,exports:s,options:a}}},function(t,e,r){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var i=function(t){return!isNaN(parseFloat(t))&&isFinite(t)};e.default={props:{val:{default:0},max:{default:100},size:{default:3},"bg-color":{type:String,default:"#eee"},"bar-color":{type:String,default:"#2196f3"},"bar-transition":{type:String,default:"all 0.5s ease"},"bar-border-radius":{type:Number,default:0},spacing:{type:Number,default:4},text:{type:String,default:""},"text-align":{type:String,default:"center"},"text-position":{type:String,default:"bottom"},"font-size":{type:Number,default:13},"text-fg-color":{type:String,default:"#222"}},computed:{pct:function(){var t=this.val/this.max*100;return t=t.toFixed(2),Math.min(t,this.max)},size_px:function(){switch(this.size){case"tiny":return 2;case"small":return 4;case"medium":return 8;case"large":return 12;case"big":return 16;case"huge":return 32;case"massive":return 64}return i(this.size)?this.size:32},text_padding:function(){switch(this.size){case"tiny":case"small":case"medium":case"large":case"big":case"huge":case"massive":return Math.min(Math.max(Math.ceil(this.size_px/8),3),12)}return i(this.spacing)?this.spacing:4},text_font_size:function(){switch(this.size){case"tiny":case"small":case"medium":case"large":case"big":case"huge":case"massive":return Math.min(Math.max(Math.ceil(1.4*this.size_px),11),32)}return i(this.fontSize)?this.fontSize:13},progress_style:function(){var t={background:this.bgColor};return"middle"!=this.textPosition&&"inside"!=this.textPosition||(t.position="relative",t["min-height"]=this.size_px+"px",t["z-index"]="-2"),this.barBorderRadius>0&&(t["border-radius"]=this.barBorderRadius+"px"),t},bar_style:function(){var t={background:this.barColor,width:this.pct+"%",height:this.size_px+"px",transition:this.barTransition};return this.barBorderRadius>0&&(t["border-radius"]=this.barBorderRadius+"px"),"middle"!=this.textPosition&&"inside"!=this.textPosition||(t.position="absolute",t.top="0",t.height="100%",t["min-height"]=this.size_px+"px",t["z-index"]="-1"),t},text_style:function(){var t={color:this.textFgColor,"font-size":this.text_font_size+"px","text-align":this.textAlign};return"top"!=this.textPosition&&"middle"!=this.textPosition&&"inside"!=this.textPosition||(t["padding-bottom"]=this.text_padding+"px"),"bottom"!=this.textPosition&&"middle"!=this.textPosition&&"inside"!=this.textPosition||(t["padding-top"]=this.text_padding+"px"),t}}}},function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[t.text.length>0&&"top"==t.textPosition?r("div",{staticClass:"vue-simple-progress-text",style:t.text_style},[t._v(t._s(t.text))]):t._e(),t._v(" "),r("div",{staticClass:"vue-simple-progress",style:t.progress_style},[t.text.length>0&&"middle"==t.textPosition?r("div",{staticClass:"vue-simple-progress-text",style:t.text_style},[t._v(t._s(t.text))]):t._e(),t._v(" "),t.text.length>0&&"inside"==t.textPosition?r("div",{staticStyle:{position:"relative",left:"-9999px"},style:t.text_style},[t._v(t._s(t.text))]):t._e(),t._v(" "),r("div",{staticClass:"vue-simple-progress-bar",style:t.bar_style},[t.text.length>0&&"inside"==t.textPosition?r("div",{style:t.text_style},[t._v(t._s(t.text))]):t._e()])]),t._v(" "),t.text.length>0&&"bottom"==t.textPosition?r("div",{staticClass:"vue-simple-progress-text",style:t.text_style},[t._v(t._s(t.text))]):t._e()])},staticRenderFns:[]}}]).default},t.exports=e()}}]);
//# sourceMappingURL=35.3b4e7c.js.map