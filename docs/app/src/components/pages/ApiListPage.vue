<template>
    <div class="api-detail-list-ctn" v-if="apiListArrayed.length">
        <div class="api-detail-list-item" v-for="api in apiListArrayed" :key="api.url">
            <div class="api-detail-info">
                <mu-icon v-if="api.icon" class="api-detail-icon" slot="left" :value="api.icon" :size="244"/>
                <div class="api-detail-url">{{ api.url }}</div>
                <div class="api-detail-name" v-if="api.name">{{ api.name }}</div>
            </div>
            <mu-table v-if="api.param && api.param.length" :class="'api-detail-param'" :enableSelectAll="true" :multiSelectable="true">
                <mu-thead>
                    <mu-tr>
                        <mu-th>名称</mu-th>
                        <mu-th>输入</mu-th>
                        <mu-th>备注</mu-th>
                        <mu-th>是否必须</mu-th>
                        <mu-th>类型</mu-th>
                    </mu-tr>
                </mu-thead>
                <mu-tbody>
                    <mu-tr v-for="param in api.param" :key="param.name" :selected="param.required">
                        <mu-td :title="param.name">{{ param.name }}</mu-td>
                        <mu-td class="param-val-input-td"><mu-text-field :hintText="param.name" class="param-val-input" fullWidth/></mu-td>
                        <mu-td :title="param.desc">{{ param.desc }}</mu-td>
                        <mu-td :title="param.required?'必须':'非必需'">
                            <mu-icon v-if="param.required" :value="code" :size="24" />
                        </mu-td>
                        <mu-td :title="param.type">{{ param.type }}</mu-td>
                    </mu-tr>
                </mu-tbody>
            </mu-table>
            <div v-else class="api-detail-param no-param">此API无需任何参数</div>
            <div class="api-detail-send">
                <mu-text-field label="请求发送地址" labelFloat/>
                <mu-raised-button label="发送" secondary/>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                apiList:[]
            };
        },
        computed:{
            apiListArrayed(){
                let ret = [];
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
        }
    }
</script>

<style>
.api-detail-list-ctn{
    height: calc(100% - 54px);
    overflow-y:auto;
}

.api-detail-list-item{
    width:100%;
    position:relative;
    font-size:16px;
    min-height:144px;
    padding:20px;
    overflow:hidden;
    position: relative;
}

.api-detail-list-item:nth-of-type(odd){
    background-color: white;
}

.api-detail-list-item:nth-of-type(even){
    background-color: rgba(255, 0, 0, .05);
}

.api-detail-info{
    width:100%;
    position: relative;
    z-index:20;
}

.api-detail-icon{
    opacity:.1;
    position: absolute;
    left:-70px;
    top:-70px;
    z-index:22;
    transition: .8s;
}

.api-detail-list-item:nth-of-type(even) .api-detail-icon{
    color: #ff5252;
    left:auto;
    right:-70px;
}

.api-detail-list-item:nth-of-type(odd):hover .api-detail-icon{
    left:-20px;
}

.api-detail-list-item:nth-of-type(even):hover .api-detail-icon{
    right:-20px;
}

.api-detail-url{
    font-size:24px;
    color: #ff5252;
}
.api-detail-param{
    z-index:21;
    position: relative;
    margin-top:20px;
    border:1px solid rgba(255, 82, 82, .2);
}

.api-detail-param.no-param{
    border:none;
}

.api-detail-param .mu-table{
    background-color: rgba(255, 255, 255, .5);
}

.api-detail-param .mu-table tbody{
    background-color: white;
}

.api-detail-param .mu-th, .api-detail-param .mu-td{
    font-size:14px;
}

.api-detail-param .mu-td{
    overflow:hidden;
    text-overflow: ellipsis;
}
.api-detail-send{
    position:relative;
    z-index:22;
    margin-top:12px;
    display:flex;
}

.api-detail-send .mu-text-field{
    flex:1;
}

.api-detail-send .mu-raised-button{
    flex:0 0 100px;
    margin:24px 0 0 20px;
}

.param-val-input .mu-text-field-content{
    padding-top:10px;
    padding-bottom:4px;
}

</style>
