<!DOCTYPE html>
<html>
@include('layouts.partials.head')
<body>
<div id="app">
@include('layouts.partials.navbar')
@yield('content')
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>