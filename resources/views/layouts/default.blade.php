<!DOCTYPE html>
<html>
@include('layouts.partials.head')
<body>
<div id="app">
<navbar></navbar>
@yield('content')
@include('layouts.partials.footer')
</div>
<script src="{{ asset('js/modernizr-custom.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
<script>
    window.cookieconsent.initialise({
        "palette": {
            "popup": {
                "background": "#252e39"
            },
            "button": {
                "background": "#0085A1"
            }
        },
        "content": {
            "href": "www.operation-braveheart/cookie-policy"
        }
    });
</script>
@include('layouts.partials.analytics')
@stack('scripts')
</body>
</html>