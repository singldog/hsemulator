<template>
    <div class="api-detail-list-ctn" v-if="apiListArrayed.length">
        <api-list-page-item v-for="api in apiListArrayed" :key="api.url" :data-url="api.url" :class="api.hightlighted?['hightlighted']:[]" :api="api"></api-list-page-item>
    </div>
</template>

<script>
import ApiListPageItem from './ApiListPageItem';
    export default {
        data(){
            return {
                apiList:[]
            };
        },
        components:{
            ApiListPageItem
        },
        computed:{
            apiListArrayed(){
                let ret = [];
                window.apiList = this.apiList;
                for(let group in this.apiList){
                    if(this.apiList.hasOwnProperty(group)){
                        for(let api in this.apiList[group]){
                            if(this.apiList[group].hasOwnProperty(api)){
                                let apiProcessed = this.apiList[group][api];
                                ret.push(apiProcessed);
                            }
                        }
                    } 
                }
                return ret;
            }
        },
        mounted(){
            let list = this;

            app.$on('onApiRefreshed', data=>{
                list.$set(list, 'apiList', data.apiList);
            });

            app.$on('onApiMenuClicked', data=>{
                let apiBlock = document.querySelectorAll('.api-detail-list-item[data-url=\''+data.url+'\']')[0];
                let page = document.getElementsByClassName('api-detail-list-ctn')[0];
                let menuOffset = data.menuOffset;
                let scrollTo = Math.max(
                    //限制头部不会超出
                    Math.min(apiBlock.offsetTop - menuOffset + 100, apiBlock.offsetTop - 48), 
                    //限制底部不会超出
                    apiBlock.offsetTop - page.offsetHeight + apiBlock.offsetHeight,
                    0
                );
                
                let velo = 1;
                let speed = 1;
                let direction = scrollTo>page.scrollTop?1:-1;
                let scrollFunc = ()=>{
                    velo+=1;
                    speed+=velo;
                    let scrollTmp = page.scrollTop + speed*direction;
                    if((direction==1&&(scrollTmp >= scrollTo)) || (direction==-1&&(scrollTmp <= scrollTo))){
                        scrollTmp = scrollTo;
                    }else{
                        window.requestAnimationFrame(scrollFunc);
                    }
                    page.scrollTop = scrollTmp;
                };
                window.requestAnimationFrame(scrollFunc);

                list.apiListArrayed.forEach(e=>{
                    Vue.set(e, 'hightlighted', false);
                    if(e.url == data.url){
                        Vue.set(e, 'hightlighted', true);
                    }
                });
            });
        }
    }
</script>

<style>
.api-detail-list-ctn{
    height: calc(100% - 54px);
    overflow-y:auto;
}

</style>
