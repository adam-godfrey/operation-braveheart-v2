<!DOCTYPE html>
<html>
@include('layouts.admin-partials.head')
<body id="page-top">
<div id="app">
	<!-- Page Wrapper -->
	<div id="wrapper">
		@include('layouts.admin-partials.sidebar')
		@include('layouts.admin-partials.main-content')
	</div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>