<template>
    <div class="footer-bar relative left-0">
        <input type="text" class="w-full mr-5 bg-transparent outline-none" v-model="item.message" @keyup.enter="sendMessage(conversation_id)" placeholder="Enter message...">
        <div class="flex ml-auto">
            <button class="btn btn-icon btn-icon_large btn_outlined btn_primary mr-5"><span class="la la-paperclip text-xl leading-none"></span></button>
            <button :class="[item.message ?  'btn_success': 'btn_primary','btn','uppercase']"  @click="sendMessage(conversation_id)"  ><span class="la la-paper-plane text-xl leading-none mr-2"></span>Send</button>
        </div>
    </div>
</template>
<script>
export default {
    props : ['conversation_id'],
    data:function() {
        return {
            item : {
                message:""
            }
        }    
    },
    methods:{
        sendMessage(conversation_id) {
            if(this.item.message == ''){
                return;
            }
            axios.post('api/send/message',{
                item : this.item,
                conversation_id : this.conversation_id,
            }).then( response => {
                this.item.message =""
                this.$emit('messageSent',conversation_id);
            }).catch(error =>{
                console.log(error);
            })
        }
    }
}
</script>