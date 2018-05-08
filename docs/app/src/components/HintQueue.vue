<template>
    <mu-popup position="top" :overlay="false" popupClass="pop-up-hint-queue" :open="hasHint">
        <transition-group name="hint-message" >
            <mu-paper v-for="hint in hints" :key="JSON.stringify(hint)" class="pop-up-hint">{{ hint.message }}</mu-paper>
        </transition-group>
    </mu-popup>
</template>

<script>
    export default{
        data(){
            return {
                hints:[]
            }
        },
        computed:{
            hasHint(){
                return this.hints && this.hints.length ? true : false;
            }
        },
        methods : {
            hint(message, time){
                if(!time){
                    time = 2500;
                }
                this.hints.unshift({
                    message,
                    timestamp:new Date().valueOf()
                });
                setTimeout(()=>{
                    this.hints.splice(this.hints.indexOf(message), 1);
                }, time);
            }
        }
    }
</script>
<style>

.mu-popup.pop-up-hint-queue {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  max-width: 375px;
  font-size:initial;
  background-color: transparent;
}

.pop-up-hint{
    margin-top:12px;
    opacity: 1;
    padding:10px 16px;
}

.hint-message-enter-to, .hint-message-leave{
    transition: 0.3s;
    opacity: 1;
}

.hint-message-enter, .hint-message-leave-to{
    opacity: 0;
}

.hint-message-enter{
    margin-top:-44px;
}

</style>
