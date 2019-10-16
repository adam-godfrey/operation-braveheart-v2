
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home.index') }}">{{ Config::get('app.name') }}</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about.index') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('memorial-garden.index') }}">Memorial Garden</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('news.index') }}">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('lottery.index') }}">Lottery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shop.index') }}">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact.index') }}">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- <b-navbar toggleable="lg" type="light" variant="none fixed-top" id="mainNav">
    <div class="container">
    <b-navbar-brand href="/">Operation Braveheart</b-navbar-brand>

    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav class="ml-auto">
            <b-nav-item href="about">About</b-nav-item>
            <b-nav-item href="memorial-garden">Memorial Garden</b-nav-item>
            <b-nav-item href="lottery">Lottery</b-nav-item>
            <b-nav-item href="news">News</b-nav-item>
            <b-nav-item href="shop">Shop</b-nav-item>
            <b-nav-item href="conact">Contact</b-nav-item>
        </b-navbar-nav>
    </b-collapse>
    </div>
</b-navbar> -->


