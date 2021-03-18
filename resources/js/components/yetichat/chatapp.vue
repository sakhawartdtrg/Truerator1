<template>
  <div class="grid grid-cols-12">
    <div class="col-start-1 sm:col-end-8 md:col-end-10">
      <chatmeta v-if="meta" :meta="meta" />
      <messagelist :items="items" :relation_id="relation_id" />
      <messagebar
        @messageSent="getMessages"
        :conversation_id="conversation_id"
      />
    </div>
    <!-- <div class="col-span-2"> -->
    <chatrightbar @openchat="getMessages" />
    <!-- </div> -->
  </div>
</template>
<script>
import messagebar from "./messagebar.vue";
import chatmeta from "./chatmeta.vue";
import chatrightbar from "./chatrightbar.vue";
import Messagelist from "./messagelist.vue";
export default {
  props: ["relation_id"],
  data: function () {
    return {
      items: [],
      meta: null,
      conversation_id: null,
    };
  },
  components: {
    messagebar,
    chatrightbar,
    Messagelist,
    chatmeta,
  },
  methods: {
    getMessages(id) {
      this.conversation_id = id;
	  
      axios
        .get("api/get/messages/" + id)
        .then((response) => {
          	this.items = response.data.data;
		  	this.scrollToEnd();
        })
        .catch((error) => {
          console.log(error);
        });
      axios
        .get("/api/get/conversation/" + this.conversation_id)
        .then((response) => {
          this.meta = response.data.data;
        });
    },
	scrollToEnd: function() {    	
      var container = this.$el.querySelector("#messagelist");
      container.scrollTop = container.scrollHeight;
    },
  },
  created() {},
};
</script>