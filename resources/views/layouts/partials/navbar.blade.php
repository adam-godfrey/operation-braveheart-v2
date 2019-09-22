<!-- Navigation -->
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
