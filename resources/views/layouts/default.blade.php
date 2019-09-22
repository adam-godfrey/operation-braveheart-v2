<!DOCTYPE html>
<html>
@include('layouts.partials.head')
<body>
<div id="app">
@include('layouts.partials.navbar')
@yield('content')
@include('layouts.partials.footer')
</div>
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>