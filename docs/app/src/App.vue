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
            <mu-appbar title="HSE"></mu-appbar>
        </div>
    </div>
</template>

<script>
import ServerSelector from './components/ServerSelector.vue';
import HintQueue from './components/HintQueue.vue';
import ApiMenuList from './components/ApiMenuList.vue';
export default {
    components: {
      ServerSelector,
      HintQueue,
      ApiMenuList
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
            Vue.http.get(this.selectedServer.url+'sys/api').then((response)=>{
                if(response.body && response.body.success){
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
        changeServer(data){
            this.selectedServer = data.selectedServer;
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
}

html, body, .page-split, .page-split>*{
    height:100%;
}

.mu-appbar{
    height:56px;
}
.mu-appbar-title{
    line-height:56px;
}

.page-split{
    display:flex;
    box-sizing:border-box;
}

.split-cell>*{
    z-index:20;
}

.split-cell-left{
    flex: 2;
    min-width:300px;
    z-index:11;
    background-color: rgb(233, 233, 233);
}

.api-list-ctn{
    height: calc(100% - 56px);
    box-sizing: border-box;
    overflow-y:auto;
    -webkit-overflow-scrolling: touch;
    position:relative;
}

.api-list-ctn::-webkit-scrollbar{
    display:none;
}

.split-cell-right{
    flex: 8;
    box-shadow:0 0 60px 0 rgba(0, 0, 0, .15);
    z-index:10;
}

.split-cell-right .mu-appbar{
    text-align:center;
}

</style>
