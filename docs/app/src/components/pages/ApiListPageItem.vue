<template>
    <div class="api-detail-list-item">
        <div class="api-detail-info">
            <mu-icon v-if="apiPro.icon" class="api-detail-icon" slot="left" :value="apiPro.icon" :size="244"/>
            <div class="api-detail-url">
                {{ apiPro.url }} 
                <div class="modifyTime tooltip-icon" 
                v-if="apiPro.modifyTimeFormatted" 
                ref="modifyTimeIcon" 
                @mouseenter="showModifyTime"
                @mouseleave="hideModifyTime">
                    <mu-icon 
                        value="brush" 
                        size="28" >
                    </mu-icon>
                    <mu-tooltip 
                        :show="modifyTimeShow" 
                        :trigger="modifyTimeTooltipTrigger" 
                        :label="'最后修改于 '+apiPro.modifyTimeFormatted"
                        verticalPosition="bottom" 
                        horizontalPosition="left"
                    />
                </div>
                <div class="createTime tooltip-icon" 
                v-if="apiPro.createTimeFormatted" 
                ref="createTimeIcon" 
                @mouseenter="showCreateTime"
                @mouseleave="hideCreateTime">
                    <mu-icon 
                        value="add_circle" 
                        size="28" 
                        >
                    </mu-icon>
                    <mu-tooltip 
                        :show="createTimeShow" 
                        :trigger="createTimeTooltipTrigger" 
                        :label="'创建于 '+apiPro.createTimeFormatted"
                        verticalPosition="bottom" 
                        horizontalPosition="left"
                    />
                </div>
            </div>
            <div class="api-detail-name" v-if="apiPro.name">{{ apiPro.name }}</div>
            <!-- <div class="api-detail-date">
                {{ apiPro.createTimeFormatted?'创建于：'+apiPro.createTimeFormatted:'' }}
                {{ apiPro.modifyTimeFormatted?'最后修改于：'+apiPro.modifyTimeFormatted:'' }}    
            </div> -->
        </div>
        <mu-table v-if="apiPro.param && apiPro.param.length" :class="'api-detail-param'" :showCheckbox="false">
            <mu-thead>
                <mu-tr>
                    <mu-th width="10%">选择</mu-th>
                    <mu-th>名称</mu-th>
                    <mu-th>释义</mu-th>
                    <mu-th width="20%">输入</mu-th>
                    <mu-th width="10%">是否必须</mu-th>
                    <mu-th>类型</mu-th>
                    <mu-th>允许值、默认值</mu-th>
                    <mu-th>备注</mu-th>
                </mu-tr>
            </mu-thead>
            <mu-tbody>
                <mu-tr v-for="param in apiPro.param" :key="param.name" >
                    <mu-td><mu-checkbox v-model="param.selected" :disabled="param.required"/> <br/></mu-td>
                    <mu-td :title="param.name">{{ param.name }}</mu-td>
                    <mu-td :title="param.desc">{{ param.desc }}</mu-td>
                    <mu-td><mu-text-field :hintText="param.desc" fullWidth class="param-val-input" spellcheck="false" v-model="param.inputVal"/></mu-td>
                    <mu-td :title="param.required?'必须':'非必需'">
                        <mu-icon :value="param.required?'done':'clear'" :size="24" />
                    </mu-td>
                    <mu-td :title="param.type">{{ param.type?param.type:'未指定' }}</mu-td>
                    <mu-td :title="param.valueAllowed">{{ param.valueAllowed }} 
                        {{ param.hasOwnProperty('default')?' => '+ param.default:''}}</mu-td>
                    <mu-td :title="param.desc">{{ param.desc }}</mu-td>
                </mu-tr>
            </mu-tbody>
        </mu-table>
        <div v-else class="api-detail-param no-param">此API无需任何参数</div>
        <div class="api-detail-send">
            <mu-text-field label="请求发送地址" v-model="urlConnected" labelFloat spellcheck="false" @change="setTypedUrl"/>
            <mu-raised-button label="发送" secondary/>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                createTimeShow: false,
                modifyTimeShow: false,
                createTimeTooltipTrigger: null,
                modifyTimeTooltipTrigger: null,
            }
        },
        props:{
            api: null
        },
        computed:{
            apiPro(){
                let apiProcessed = this.api;
                //设置参数
                let params = apiProcessed.param;
                if(params){
                    params.forEach(param=>{
                        if(!param.hasOwnProperty('selected')){
                            Vue.set(param, 'selected', true);
                        }
                    });
                }
                //设置日期
                if(apiProcessed.hasOwnProperty('createTime')){
                    let date = new Date(apiProcessed.createTime*1000);
                    let mon = date.getMonth()+1;
                    let day = date.getDate();
                    let hour = date.getHours();
                    let moa = hour<12?'上午':'下午';
                    Vue.set(apiProcessed, 'createTimeFormatted', `${mon}月${day}日 ${moa}${hour}点`);
                }
                
                if(apiProcessed.hasOwnProperty('modifyTime')){
                    let date2 = new Date(apiProcessed.modifyTime*1000);
                    let mon2 = date2.getMonth()+1;
                    let day2 = date2.getDate();
                    let hour2 = date2.getHours();
                    let moa2 = hour2<12?'上午':'下午';
                    Vue.set(apiProcessed, 'modifyTimeFormatted', `${mon2}月${day2}日 ${moa2}${hour2}点`);
                }

                return apiProcessed;
            },
            urlConnected(){
                if(this.typedInUrl){
                    return this.typedInUrl;
                }
                let ret = app.selectedServer.url+this.api.url;
                let paramStr = '';
                let pinned = false;
                if(this.apiPro.param){
                    this.apiPro.param.forEach(e=>{
                        if(e.selected){
                            if(pinned){
                                paramStr+='&';
                            }
                            if(e.hasOwnProperty('inputVal')){
                                paramStr+=`${e.name}=${e.inputVal}`;
                            }else{
                                paramStr+=`${e.name}`;
                            }
                            pinned = true;
                        }
                    });
                    if(paramStr.length){
                        ret+='?'+paramStr;
                    }
                }
                return ret;
            }
        },
        mounted(){
            this.createTimeTooltipTrigger = this.$refs.createTimeIcon;
            this.modifyTimeTooltipTrigger = this.$refs.modifyTimeIcon;
        },
        methods:{
            showCreateTime(){
                this.createTimeShow = true;
            },
            hideCreateTime(){
                this.createTimeShow = false;
            },
            showModifyTime(){
                this.modifyTimeShow = true;
            },
            hideModifyTime(){
                this.modifyTimeShow = false;
            },
            setTypedUrl(event){
                this.typedInUrl = event.target.value;
            }
        },
        watch:{
            'api.param':{
                deep: true,
                handler: function(){
                    this.typedInUrl = null;
                }
            }
        }
    }
</script>

<style>


.api-detail-list-item{
    width:100%;
    position:relative;
    font-size:16px;
    min-height:144px;
    padding:20px;
    overflow:hidden;
    position: relative;
    box-shadow:0 0 20 0 transparent inset;
}

.api-detail-list-item.hightlighted{
    /*border:1px solid rgba(255, 82, 82, .5);*/
    box-shadow:0 0 5px 0 #ff5252 inset;
    transition: .5s;
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

.api-detail-info>*{
    z-index:23;
    position: relative;
}

.api-detail-icon{
    opacity:.08;
    position: absolute;
    left:-70px;
    top:-70px;
    z-index:22;
    transition: .8s;
    cursor: default;
    user-select:none;
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
    line-height:48px;
    color: #ff5252;
    vertical-align: middle;
}

.api-detail-url .tooltip-icon{
    color: #7e848c;
    float:right;
    margin:5px 0 0 18px;
    cursor: default;
    user-select: none;
    position: relative;
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

