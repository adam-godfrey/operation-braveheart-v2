<template>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav"  v-bind:class="{ 'navbarOpen': show }">
        <div class="container">
            <a class="navbar-brand" href="{{ routes.home }}">Operation Braveheart</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" v-on:click="toggleNavbar">
                Menu
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive" v-bind:class="{ in: show }">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ routes.about }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ routes.memorial-garden }}">Memorial Garden</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ routes.news }}">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ routes.lottery }}">Lottery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ routes.shop }}">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ routes.contact }}">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'navbar',
    props: {
        routes: {
            type: Object
        }
    }
    data() {
        return {
            show: true
        }
    },
    methods: {
        toggleNavbar() {
             this.show = !this.show;
        }
    },
    computed: {

    }
</script>