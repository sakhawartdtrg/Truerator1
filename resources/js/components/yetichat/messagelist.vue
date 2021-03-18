<template>
    <div class="relative flex-grow">
        <div class="w-full top-0 bottom-0 overflow-y-scroll"  style="height:400px" id="messagelist" v-chat-scroll="{always: false, smooth: true}">
            <div v-for="item in items">
                <listitem 
                    :item="item" :relation_id="relation_id"
                />
            </div>
        </div>
    </div>
</template>
<script>

import listitem from './listitem.vue';
export default {
    props : ['items','relation_id'],
    components : {
        listitem
    }
}
</script>
