<template>
  <div id="app" class="page-split">
        <hint-queue ref="hintQueue"></hint-queue>
        <div class="split-cell split-cell-left">
            <mu-appbar title="API列表">
                <mu-flat-button label="刷新页面" slot="right" onclick="window.location.reload();"></mu-flat-button>
            </mu-appbar>
            <div class="api-list-ctn" ref="refreshList">
                <mu-refresh-control :refreshing="refreshing" :trigger="refreshTrigger" @refresh="refreshApiList"/>
                <server-selector v-on:serverChanged="changeServer" ref="serverSelector"></server-selector>
                <api-menu-list :apiList="apiList"></api-menu-list>
            </div>
        </div>
        <div class="split-cell split-cell-right">
            <tab-page :pagesOnInit="[
                {
                    title : 'API列表',
                    type : 'api-list-page',
                    dataDelivered : [],
                    activate : true
                }
            ]"></tab-page>
        </div>
    </div>
</template>

<script>
import ServerSelector from './components/ServerSelector.vue';
import HintQueue from './components/HintQueue.vue';
import ApiMenuList from './components/ApiMenuList.vue';
import TabPage from './components/TabPage.vue';
export default {
    components: {
      ServerSelector,
      HintQueue,
      ApiMenuList,
      TabPage
    },
    data(){
        return {
            selectedServer : null,
            refreshTrigger : null, 
            refreshing : false, 
            apiList : []
        }
    },
    methods:{
        hint(message, time){
            return this.$refs.hintQueue.hint(message, time);
        },
        refreshApiList(){
            if(!this.selectedServer){
                return;
            }
            this.refreshing = true;
            Vue.http.get(this.selectedServer.url+'sys/api', {
                params:{
                    'requireRedundant' : 1
                }
            }).then((response)=>{
                if(response.body && response.body.success){
                    app.$emit('onApiRefreshed', {apiList:response.body.data});
                    this.apiList = response.body.data;
                    this.hint('API列表已刷新', 1400);
                }
                this.refreshing = false;
            }, (error)=>{
                    this.hint('网络请求错误', 2000);
                    this.refreshing = false;
                    console.log(error);
            });
        },
        changeServer(){
            this.selectedServer = this.$refs.serverSelector.selectedServerObj;
            this.refreshApiList();
        }
    },
    mounted(){
        this.refreshTrigger = this.$refs.refreshList;
    }
}
</script>

<style>

*{
    font-family: "Consolas", "DengXian";
}

body{
    font-size:1.5em;
    perspective: 1024px;
}

html, body, .page-split, .page-split>*{
    height:100%;
}

.mu-appbar{
    height:54px;
}
.mu-appbar-title{
    line-height:54px;
}

.page-split{
    display:flex;
    box-sizing:border-box;
}

.split-cell>*{
    z-index:20;
}

.split-cell-left{
    flex: 3;
    min-width:300px;
    z-index:11;
    background-color: rgb(233, 233, 233);
}

.api-list-ctn, .split-cell-right{
    height: calc(100% - 54px);
    box-sizing: border-box;
    overflow-y:auto;
    -webkit-overflow-scrolling: touch;
    position:relative;
}

.api-list-ctn::-webkit-scrollbar{
    display:none;
}

.split-cell-right{
    flex: 12;
    height: 100%;
    box-shadow:0 0 60px 0 rgba(0, 0, 0, .1);
    z-index:12;
}

.split-cell-right .mu-appbar{
    text-align:center;
}

@media screen and (max-width:720px){
    .split-cell-left{
        flex:1;
    }

    .split-cell-right{
        display:none;
    }
}

</style>
