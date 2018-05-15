<template>
    <div class="tab-pages-ctn" v-if="pages.length">
        <mu-tabs :value="currentPageKey">
            <mu-tab :title="header.title" v-for="header in pageHeaders" :key="header.key" :value="header.key" @click="activePage(header.key);"/>
        </mu-tabs>
        
        <component v-for="page in pages" :key="page.header.key" v-if="currentPageKey == page.header.key" :is="'api-list-page'" :dataDelivered="page.content.dataDelivered"></component>
    </div>
</template>

<script>
    import ApiListPage from './pages/ApiListPage';
    export default {
        data(){
            return {
                currentPageKey: 0,
                pageKeySeq: 0,
                pages: [],
            };
        },
        props:{
            pagesOnInit: []
        },
        components:{
            ApiListPage
        },
        computed:{
            pageHeaders(){
                return this.pages.pluck('header');
            }
        },
        methods:{
            spawnPageKey(){
                this.pageKeySeq++;
                return this.pageKeySeq;
            },
            pushPage(pageParam){
                let page = {
                    header:{
                        key : this.spawnPageKey(),
                        title : pageParam.title,
                    },
                    content: {
                        type : pageParam.type,
                        dataDelivered : pageParam.dataDelivered
                    }
                };
                this.pages.push(page);
                if(pageParam.activate){
                    this.activePage(page.header.key);
                }
            },
            activePage(key){
                this.currentPageKey = key;
            }
        },
        mounted(){
            //初始化预加载的页面
            if(this.pagesOnInit){
                this.pagesOnInit.forEach(page=>{
                    this.pushPage(page);
                });
            }
        }

    }
</script>

<style>
.mu-tabs{
    overflow:hidden;
    height:54px;
}

.mu-tabs button{
    font-size:18px;
}

.tab-pages-ctn{
    height:100%;
}
</style>
