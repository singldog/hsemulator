<template>
  <div id="app" class="page-split">
        <hint-queue ref="hintQueue"></hint-queue>
        <div class="split-cell split-cell-left">
            <mu-appbar title="API列表">
                <mu-flat-button label="刷新页面" slot="right" onclick="window.location.reload();"/>
            </mu-appbar>
            <server-selector></server-selector>
            <api-menu-list></api-menu-list>
        </div>
        <div class="split-cell split-cell-right">
            <mu-appbar title="HSE">

            </mu-appbar>
        </div>
    </div>
</template>

<script>
import ServerSelector from './components/ServerSelector.vue';
import HintQueue from './components/HintQueue.vue';
export default {
    components: {
      ServerSelector,
      HintQueue
    },
    methods:{
        hint(message){
            return this.$refs.hintQueue.hint(message);
        }
    }
}
</script>

<style>
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

.split-cell-right{
    flex: 8;
    box-shadow:0 0 60px 0 rgba(0, 0, 0, .15);
    z-index:10;
}

.split-cell-right .mu-appbar{
    text-align:center;
}
</style>
