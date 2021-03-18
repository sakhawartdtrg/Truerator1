<template>
    <div v-if="relation_id==item.sender_id" class="card flex items-start w-11/12 ml-auto mt-5 p-5 bg-primary dark:bg-primary text-white" >
        {{item.message}}
        <!-- <span class="capitalize block text-gray-600 text-xs"></span> -->
        <span class="whitespace-no-wrap ml-auto text-right pl-5 text-gray-600 text-xs">{{item.user.first_name}} {{item.user.last_name}} {{ item.created_at | formatDate}} </span>
    </div>
    <div v-else class="card flex items-start w-11/12 mt-5 p-5">
        {{item.message}}
        <!-- <span class="capitalize block text-gray-600 text-xs"></span> -->
        <span class="whitespace-no-wrap ml-auto text-right pl-5 text-gray-600">{{ item.created_at | formatDate}}</span>
    </div>
</template>
<script>
export default {
    data:function(){
        return{
            
        } 
    },
    props : ['item','relation_id'],
}
</script>