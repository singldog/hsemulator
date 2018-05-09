<template>
    <mu-paper class="select-server-paper" :zDepth="1">
        <mu-select-field label="选择api服务器" class="select-server" ref="serverSelect" v-model="selectedServer">
            <mu-menu-item v-for="(elem, index) in serverSet" :key="elem.url" :value="index" :title="elem.name" />
        </mu-select-field>
        <mu-float-button icon="add" secondary mini class="add-server-btn" ref="button" @click="toggle"/>
        <mu-popover :trigger="trigger" :open="open" @close="handleClose" 
        :anchorOrigin="{vertical:'center', horizontal:'right'}"  
        :targetOrigin="{vertical:'center', horizontal:'left'}" 
        id="add-server-pop" popoverClass="add-server-pop">
            <mu-paper class="add-server-form">
                <mu-text-field label="服务器名称" v-model="newServerName" spellcheck="false" class="server-name-input"/><br/>
                <mu-text-field label="添加服务器" hintText="新的API服务器地址" v-model="newServerUrl" spellcheck="false" class="server-select-input"/><br/>
                <mu-float-button icon="done" secondary mini class="submit-new-server-btn" ref="button" @click="submit()"/>
            </mu-paper>
        </mu-popover>
    </mu-paper>
</template>

<script>
    export default {
        data () {
            return {
                open: false,
                trigger: null,
                newServerUrl: '',
                newServerName: '',
                selectedServerNum: 0,
                serverSet: [
                    {
                        name : '阿里云服务器',
                        url : 'http://47.94.15.53:8010/'
                    },
                    {
                        name : '本地服务器',
                        url : 'http://local-api.hse.com/'
                    }
                ]
            }
        },
        computed:{
            selectedServer:{
                get(){
                    return this.selectedServerNum;
                },
                set(val){
                    this.selectedServerNum = val;
                    this.emitChange();
                }
            },
            selectedServerObj:{
                get(){
                    return this.serverSet[this.selectedServer];
                }
            }
        },
        mounted () {
            this.trigger = this.$refs.button.$el
            this.selectedServer = 0;
        },
        methods: {
            toggle () {
                this.open = !this.open
                if(this.open){
                    this.resetInput();
                }
            },
            resetInput(){
                this.newServerUrl = "http://";
                this.newServerName = "新建服务器";
            },
            handleClose (e) {
                this.open = false
            },
            emitChange(){
                this.$emit('serverChanged', {selectedServer:this.selectedServerObj});
            },
            submit(){
                let push = true;
                this.serverSet.forEach(elem=>{
                    if(elem.url == this.newServerUrl){
                        push = false;
                        return false;
                    }
                })
                if(!push){
                    app.$refs.app.hint('已经存在相同URL的服务器地址');
                    return;
                }
                let newServer = {
                    name: this.newServerName,
                    url: this.newServerUrl,
                };
                let newLength = this.serverSet.push(newServer);
                this.selectedServer = newLength-1;
                this.toggle();
            }
        }
    }
</script>

<style>
.select-server-paper{
    width:calc(100% - 20px);
    margin:10px 10px 12px;
    padding:10px 15px 5px;
    display:flex;
}

.select-server{
    flex:1;
}

.add-server-btn{
    align-self: center;
    margin-left:15px;
}

.add-server-pop{
    width:720px;
    margin-left:15px;
}
.add-server-form{
    display:flex;
    padding:8px 12px 0px;
}

.add-server-form .server-name-input{
    flex:0 0 150px;
}

.add-server-form .server-select-input{
    flex:1;
    margin-left:12px;
}

.add-server-form .submit-new-server-btn{
    flex:0 0 40px;
    align-self: center;
    margin-left:12px;
}

.add-server-pop{
    transform-origin:-30px center;
    transition:transform .3s, opacity .3s;
}

.add-server-pop.mu-popover-enter{
    transform:scale(.7,.95);
}

.add-server-pop.mu-popover-leave{
    transform:none;
}

.add-server-pop.mu-popover-leave-to{
    transform:scale(.7,.95);
}


@media screen and (max-width:720px){
    .add-server-pop{
        width:calc(100% - 30px);
        margin-top:64px;
        transform-origin: center -150px;
        line-height:0;
        transition:transform .5s, opacity .5s;
    }

    .add-server-pop .add-server-form{
        flex-direction:column;
        height:auto;
        padding: 12px 15px;
    }

    .add-server-form .server-name-input{
        flex:auto;
        width:100%;
    }

    .add-server-form .server-select-input{
        flex:auto;
        width:100%;
        margin-left: 0;
    }

    .add-server-form .submit-new-server-btn{
        align-self: center;
        margin-left: 0;
        margin:4px;
    }

    .add-server-pop.mu-popover-enter{
        transform:scale(.85, .85) translateY(-40px) rotateX(-36deg);
    }

    .add-server-pop.mu-popover-leave{
        transform:none;
    }

    .add-server-pop.mu-popover-leave-to{
        transform:scale(.85, .85) translateY(-40px) rotateX(-36deg);
    }

}

</style>



