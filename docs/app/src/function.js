Array.prototype.pluck = function(key){
    let ret = [];
    this.forEach((val, name)=>{
        ret.push(val[key]);
    });
    return ret;
}

Array.prototype.pluckMap = function(key){
    if(!Array.isArray(key)){
        key = [key];
    }
    let ret = [];
    key.forEach(searchName=>{
        ret[searchName] = [];
        this.forEach(val=>{
            ret[searchName].push(val[searchName]);
        });
    });
    return ret;
}