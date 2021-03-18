<template>
    <aside class="sidebar fixed">

        <!-- Toggler - Mobile -->
        <button class="sidebar-toggler bg-white p-2 shadow la la-ellipsis-v text-4xl leading-none" data-toggle="sidebar"></button>

        <!-- Tabs -->
        <div class="tabs p-5">
            <nav class="tab-nav mt-5">
                <button class="nav-link h5 uppercase active" data-toggle="tab" data-target="#tab-1">Opened</button>
                <button class="nav-link h5 uppercase" data-toggle="tab" data-target="#tab-2">Closed</button>
            </nav>
            <div class="tab-content mt-5">

                <!-- Messages -->
                <div class="collapse open" id="tab-1" style="opacity: 1; overflow: visible;">
                    <form class="flex items-center mb-5" action="#">
                        <label class="form-control-addon-within border-secondary rounded-full overflow-hidden">
                            <input type="text" class="form-control border-none" placeholder="Search">
                            <span class="flex items-center pr-4"><button type="button" class="dark:text-gray-700 dark:hover:text-primary text-secondary hover:text-primary btn btn-link la la-search text-2xl leading-none"></button></span>
                        </label>
                    </form>
                    <div id="opened-items" v-for="item in opened">
                        <div class="flex items-center py-5 cursor-pointer" v-on:click="openchat(item.id)">
                            <div>
                                <h5 class="uppercase">{{item.lead.name}}</h5>
                                <p>{{item.lead.cell_no}} {{item.lead.email}}</p>
                            </div>
                            <small class="ml-auto pl-5">{{ item.created_at | formatDate}}</small>
                        </div>
                        <hr>
                    </div>
                </div>

                <!-- Contacts -->
                <div class="collapse" id="tab-2"  style="overflow: hidden; height: 0px; opacity: 0;">
                    <form class="flex items-center mb-5" action="#">
                        <label class="form-control-addon-within border-secondary rounded-full overflow-hidden">
                            <input type="text" class="form-control border-none" placeholder="Search">
                            <span class="flex items-center pr-4"><button type="button" class="dark:text-gray-700 dark:hover:text-primary text-secondary hover:text-primary btn btn-link la la-search text-2xl leading-none"></button></span>
                        </label>
                    </form>
                    <div id="closed-items" v-for="item in closed">
                        <div class="flex items-center py-5 cursor-pointer">
                            <div>
                                <h5 class="uppercase">{{item.lead.name}}</h5>
                                <p>{{item.lead.cell_no}} {{item.lead.email}}</p>
                            </div>
                            <small class="ml-auto pl-5">{{ item.created_at | formatDate}}</small>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</template>
<script>
export default {
    data:function(){
        return {
            opened : null,
            closed : null,
        }
    },
    mounted() {
        axios.get('/api/conversations/1').then(response=> {
            this.opened = response.data.data;
            this.$emit('openchat',this.opened[0].id);
        })
        axios.get('/api/conversations/0').then(response=> {
            this.closed = response.data.data;
        })
    },
    methods:{
        openchat(id) {
            this.$emit('openchat',id);
        }
    }    
}
</script>

<style scoped>
    .sidebar{
        position: fixed !important;
    }
</style>