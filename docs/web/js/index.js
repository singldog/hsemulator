var app = new Vue({
    el:"#container",
    data: {
        res_message:null,
        message:null,
        currentItem:null,
        items:{},
        result:{},
    },
    created:function () {
        this.$http.get('http://local-api.hse.com/sys/api').then(function (res) {
            this.items = res.body.data;
            for(var item in this.items){
                for(var i=0;i<this.items[item].length;i++){
                    this.items[item][i].res=null;
                    if(this.items[item][i].param){
                        for(var j=0;j<this.items[item][i].param.length;j++){
                            this.items[item][i].param[j].val=null;
                        }
                    }
                }
            }
            console.log(this.lists);
        })
    },
    methods:{
        viewItem: function(item){
            this.currentItem = item;
        },
        simulation:function (item) {
            this.currentItem = item;
            var sim = this;
            var get_url = 'http://local-api.hse.com/'+sim.currentItem.url+'?';
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

