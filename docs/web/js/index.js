var app = new Vue({
    el:"#container",
    data: {
        res_message:null,
        message:null,
        currentItem:null,
        items:{},
        result:{},
        big_url:"http://47.94.15.53:8010/sys/api",
        list: ['阴阳师', '影之刃', '天下HD', '穿越火线', '英雄联盟', '王者荣耀']
    },
    created:function () {

        this.$http.get(this.big_url).then(function (res) {
            this.items = res.body.data;
            for(var item in this.items){
                for(var i=0;i<this.items[item].length;i++){
                    this.items[item][i].url=" \n "+this.items[item][i].url;
                    this.items[item][i].res=null;
                    if(this.items[item][i].param){
                        for(var j=0;j<this.items[item][i].param.length;j++){
                            this.items[item][i].param[j].val=null;
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
        change_url:function(text){
            console.log(text);
            console.log(this.big_url);
        },
        simulation:function (item) {
            this.currentItem = item;
            var sim = this;
            var get_url = 'http://47.94.15.53:8010/'+sim.currentItem.url+'?';
            if(this.currentItem.param){
                this.currentItem.param.forEach(function (item,index,input) {
                    if(item.val){
                        get_url = get_url+item.name+"='"+item.val+"'"+' &';
                    }
                })
            }
            sim.$http.get(get_url).then(function (res) {
                var body_text = res.bodyText;
                body_text = body_text.replace(/\,/g,'\n');
                Vue.set(item, 'res', body_text);
                this.$forceUpdate();
                console.log(item.res);
            })
        },
        open () {
            this.dialog = true
        },
        close () {
            this.dialog = false
        }
    }
});

