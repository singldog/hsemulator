webpackJsonp([0],{0:function(e,t){},"3rUP":function(e,t){},E51W:function(e,t){},VrJe:function(e,t){},YejZ:function(e,t){},iBkx:function(e,t){},kPFz:function(e,t){},lVK7:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});r("E51W"),r("VrJe");var s=r("7+uW"),n={data:function(){return{open:!1,trigger:null,newServerUrl:"",newServerName:"",selectedServerNum:0,serverSet:[{name:"阿里云服务器",url:"http://47.94.15.53:8010/"},{name:"本地服务器",url:"http://local-api.hse.com/"}]}},computed:{selectedServer:{get:function(){return this.selectedServerNum},set:function(e){this.selectedServerNum=e,this.emitChange()}},selectedServerObj:{get:function(){return this.serverSet[this.selectedServer]}}},mounted:function(){this.trigger=this.$refs.button.$el,this.selectedServer=0},methods:{toggle:function(){this.open=!this.open,this.open&&this.resetInput()},resetInput:function(){this.newServerUrl="http://",this.newServerName="新建服务器"},handleClose:function(e){this.open=!1},emitChange:function(){this.$emit("serverChanged",{selectedServer:this.selectedServerObj})},submit:function(){var e=this,t=!0;if(this.serverSet.forEach(function(r){if(r.url==e.newServerUrl)return t=!1,!1}),t){var r={name:this.newServerName,url:this.newServerUrl},s=this.serverSet.push(r);this.selectedServer=s-1,this.toggle()}else app.$refs.app.hint("已经存在相同URL的服务器地址")}}},i={render:function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("mu-paper",{staticClass:"select-server-paper",attrs:{zDepth:1}},[r("mu-select-field",{ref:"serverSelect",staticClass:"select-server",attrs:{label:"选择api服务器"},model:{value:e.selectedServer,callback:function(t){e.selectedServer=t},expression:"selectedServer"}},e._l(e.serverSet,function(e,t){return r("mu-menu-item",{key:e.url,attrs:{value:t,title:e.name}})})),e._v(" "),r("mu-float-button",{ref:"button",staticClass:"add-server-btn",attrs:{icon:"add",secondary:"",mini:""},on:{click:e.toggle}}),e._v(" "),r("mu-popover",{attrs:{trigger:e.trigger,open:e.open,anchorOrigin:{vertical:"center",horizontal:"right"},targetOrigin:{vertical:"center",horizontal:"left"},id:"add-server-pop",popoverClass:"add-server-pop"},on:{close:e.handleClose}},[r("mu-paper",{staticClass:"add-server-form"},[r("mu-text-field",{staticClass:"server-name-input",attrs:{label:"服务器名称",spellcheck:"false"},model:{value:e.newServerName,callback:function(t){e.newServerName=t},expression:"newServerName"}}),r("br"),e._v(" "),r("mu-text-field",{staticClass:"server-select-input",attrs:{label:"添加服务器",hintText:"新的API服务器地址",spellcheck:"false"},model:{value:e.newServerUrl,callback:function(t){e.newServerUrl=t},expression:"newServerUrl"}}),r("br"),e._v(" "),r("mu-float-button",{ref:"button",staticClass:"submit-new-server-btn",attrs:{icon:"done",secondary:"",mini:""},on:{click:function(t){e.submit()}}})],1)],1)],1)},staticRenderFns:[]};var l={data:function(){return{hints:[]}},computed:{hasHint:function(){return!(!this.hints||!this.hints.length)}},methods:{hint:function(e,t){var r=this;t||(t=2500),this.hints.unshift({message:e,timestamp:(new Date).valueOf()}),setTimeout(function(){r.hints.splice(r.hints.indexOf(e),1)},t)}}},a={render:function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("mu-popup",{attrs:{position:"top",overlay:!1,popupClass:"pop-up-hint-queue",open:e.hasHint}},[r("transition-group",{attrs:{name:"hint-message"}},e._l(e.hints,function(t){return r("mu-paper",{key:JSON.stringify(t),staticClass:"pop-up-hint"},[e._v(e._s(t.message))])}))],1)},staticRenderFns:[]};var u={render:function(){var e=this,t=e.$createElement,r=e._self._c||t;return null!=e.apiList&&0!=e.apiList.length?r("mu-list",{staticClass:"api-menu-list"},e._l(e.apiList,function(t,s){return r("mu-list-item",{key:s,attrs:{title:s.toUpperCase(),toggleNested:""}},[r("mu-icon",{attrs:{slot:"left",value:"folder"},slot:"left"}),e._v(" "),e._l(t,function(e,t){return r("mu-list-item",{key:t,attrs:{slot:"nested",title:e.name?e.name:e.url,describeText:e.name?e.url:"",inset:""},slot:"nested"},[r("mu-icon",{attrs:{slot:"left",value:e.icon?e.icon:"toc"},slot:"left"})],1)})],2)})):e._e()},staticRenderFns:[]};var o={components:{ServerSelector:r("VU/8")(n,i,!1,function(e){r("YejZ")},null,null).exports,HintQueue:r("VU/8")(l,a,!1,function(e){r("kPFz")},null,null).exports,ApiMenuList:r("VU/8")({props:{apiList:null}},u,!1,function(e){r("3rUP")},null,null).exports},data:function(){return{selectedServer:null,refreshTrigger:null,refreshing:!1,apiList:[]}},methods:{hint:function(e,t){return this.$refs.hintQueue.hint(e,t)},refreshApiList:function(){var e=this;this.selectedServer&&(this.refreshing=!0,Vue.http.get(this.selectedServer.url+"sys/api").then(function(t){t.body&&t.body.success&&(e.apiList=t.body.data,e.hint("API列表已刷新",1400)),e.refreshing=!1},function(t){e.hint("网络请求错误",2e3),e.refreshing=!1,console.log(t)}))},changeServer:function(e){this.selectedServer=e.selectedServer,this.refreshApiList()}},mounted:function(){this.refreshTrigger=this.$refs.refreshList}},c={render:function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"page-split",attrs:{id:"app"}},[r("hint-queue",{ref:"hintQueue"}),e._v(" "),r("div",{staticClass:"split-cell split-cell-left"},[r("mu-appbar",{attrs:{title:"API列表"}},[r("mu-flat-button",{attrs:{slot:"right",label:"刷新页面",onclick:"window.location.reload();"},slot:"right"})],1),e._v(" "),r("div",{ref:"refreshList",staticClass:"api-list-ctn"},[r("mu-refresh-control",{attrs:{refreshing:e.refreshing,trigger:e.refreshTrigger},on:{refresh:e.refreshApiList}}),e._v(" "),r("server-selector",{ref:"serverSelector",on:{serverChanged:e.changeServer}}),e._v(" "),r("api-menu-list",{attrs:{apiList:e.apiList}})],1)],1),e._v(" "),r("div",{staticClass:"split-cell split-cell-right"},[r("mu-appbar",{attrs:{title:"HSE"}})],1)],1)},staticRenderFns:[]};var p=r("VU/8")(o,c,!1,function(e){r("iBkx")},null,null).exports,h=r("u64Q"),f=r.n(h),v=r("8+8L");s.default.config.productionTip=!1,s.default.use(v.a),s.default.use(f.a),s.default.config.silent=!0,window.Vue=s.default,window.app=new s.default({el:"#app",components:{App:p},template:'<App ref="app"/>'})}},["lVK7"]);
//# sourceMappingURL=app.16830ee273eea731a883.js.map