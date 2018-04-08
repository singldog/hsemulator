var app = new Vue({
    el:"#container",
    data: {
        message:null,
        currentItem:null,
        items:{},
        result:{}
    },
    created:function () {
        this.$http.get('http://47.94.15.53:8010/sys/api').then(function (res) {
            this.items = res.body.data;
            for(var item in this.items){
                for(var i=0;i<this.items[item].length;i++){
                    if(this.items[item][i].param){
                        for(var j=0;j<this.items[item][i].param.length;j++){
                            this.items[item][i].param[j].val=null;
                            console.log(this.items[item][i].param[j].val);
                        }
                    }
                }
            }
        })
    },
    methods:{
        viewItem: function(item){
            this.currentItem = item;
        },
        simulation:function () {
            for(var item in this.items){
                for(var i=0;i<this.items[item].length;i++){
                    if(this.items[item][i].param){
                        for(var j=0;j<this.items[item][i].param.length;j++){
                            this.items[item][i].param[j].val=null;
                            console.log(this.items[item][i].param[j].val);
                        }
                    }
                }
            }
        }
    }
});