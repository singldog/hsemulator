<template>
    <mu-list class="api-menu-list" v-if="apiList!=null && apiList.length!=0">
        <mu-list-item v-for="(apiGroup, groupName) in apiList" :key="groupName" :title="groupName.toUpperCase()" toggleNested>
            <mu-icon slot="left" value="folder" class='folder-icon'/>
            <mu-list-item v-for="(api, index) in apiGroup" :key="index" :title="api.name?api.name:api.url" :describeText="api.name?api.url:''" slot="nested" inset>
                <mu-icon slot="left" :value="api.icon?api.icon:'toc'" />
            </mu-list-item>
        </mu-list-item>
    </mu-list>
</template>

<script>
    export default {
        props: {
            apiList : null
        },
    }
</script>

<style>
.api-menu-list{
    background-color:rgba(255, 255, 255, 0.6);

    overflow-y:auto;
}
.api-menu-list .mu-item.show-left{
    padding-left:64px;
}

</style>