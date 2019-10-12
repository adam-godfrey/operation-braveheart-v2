<template>
    <div>
        <li class="nav-item" v-for="(item, index) in items" @click="toggleItem(index)">
            <a class="nav-link collapsed" href="#">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{item.text}}</span>
            </a>

            <transition name="slide">
                <div v-if="isActive === index" class="item-active">
                    <div class="bg-white py-2 rounded"v-html="item.html">  
                    </div>
                </div>
            </transition>
        </li>
    </div>
</template>

<script>
export default {
    data () {
        return {
            items: [
                { 
                    text: 'Memorial Garden',
                    html: `<h6 class="collapse-header">Lottery:</h6>
                        <a class="collapse-item" href="/admin/lottery">Dashboard</a>
                        <h6 class="collapse-header">Lottery Players:</h6>
                        <a class="collapse-item" href="/admin/lottery/players/create">Add New</a>
                        <a class="collapse-item" href="/admin/lottery/players">View All</a>`
                },
                { 
                    text: 'Lottery',
                    html: `<h6 class="collapse-header">Lottery:</h6>
                        <a class="collapse-item" href="/admin/lottery">Settings</a>
                        <h6 class="collapse-header">Draw Numbers:</h6>
                        <a class="collapse-item" href="/admin/lottery/draw/uk">UK</a>
                        <a class="collapse-item" href="/admin/lottery/draw/local">Local</a>
                        <h6 class="collapse-header">Lottery Players:</h6>
                        <a class="collapse-item" href="/admin/lottery/players/create">Add New</a>
                        <a class="collapse-item" href="/admin/lottery/players">View All</a>`
                },
                { 
                    text: 'News',
                    html: `<h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Add New</a>
                        <a class="collapse-item" href="cards.html">View All</a>`
                }
            ],
            isActive: null
        }
    },
    methods: {
        toggleItem(index) {
            this.isActive = this.isActive === index ? null : index;
        },
    }
};
</script>