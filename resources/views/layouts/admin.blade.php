<!DOCTYPE html>
<html>
@include('layouts.admin-partials.head')
<body id="page-top">
<div id="app">
	<vue-snotify></vue-snotify>
	<!-- Page Wrapper -->
	<div id="wrapper">
		
		@include('layouts.admin-partials.main-content')

	</div>
	<admin-sidebar/>
</div>
<script src="{{ asset('js/admin.js') }}"></script>
@stack('scripts')
</body>
</html>