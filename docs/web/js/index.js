var app = new Vue({
    el:"#container",
    data: {
        res_message:null,
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
                        }
                    }
                }
            }
            console.log(this.items);
        })
    },
    methods:{
        viewItem: function(item){
            this.currentItem = item;
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
                sim.res_message = body_text;
            })
        }
    }
});