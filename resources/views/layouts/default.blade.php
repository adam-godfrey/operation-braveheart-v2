<!DOCTYPE html>
<html>
@include('layouts.partials.head')
<body>
<div id="app">
@include('layouts.partials.navbar')
@yield('content')
@include('layouts.partials.footer')
</div>
<script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>