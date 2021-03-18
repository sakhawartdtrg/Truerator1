<template>
    <section class="flex items-center lg:justify-start mb-5">
        <div class="relative mr-1">
            <!-- <div class="bg-green absolute bottom-0 right-0 mr-1 mb-1 w-3 h-3 border border-white rounded-full">
            </div> -->
            <span class="dark:bg-gray-900 dark:border-gray-600 dark:text-gray-500 flex items-center justify-center w-12 h-12 rounded-full bg-gray-200 border-2 border-gray-600 text-xl text-gray-700 uppercase" >{{meta.lead.name[0]}}{{meta.lead.name[1]}}</span>
            <!-- <img src="assets/images/potato.jpg" class="w-full h-full rounded-full object-cover" alt=""> -->
        </div>
        <div>
            <!-- {{meta}} -->
            <h5 class="uppercase">{{meta.lead.name}}</h5>
            <p>{{meta.lead.email}}</p>
        </div>
        <hr class="dark:border-gray-800 mb-8">
    </section>
</template>
<script>
export default {
    props:['meta'],
    // data:function(){
    //     return {
    //         conversation :null,
    //     }
    // },
    // mounted() {
    //     console.log(this.conversation_id);
    //     axios.get('/api/get/conversation/'+this.conversation_id).then(response=> {
    //         this.conversation = response.data.data;
    //     })
    // }
}
</script>