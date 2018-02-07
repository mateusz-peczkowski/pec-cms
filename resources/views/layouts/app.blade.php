<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ PEC_CMS_NAME . ' v.' . PEC_CMS_VERSION }}@yield('title')</title>
    <meta name="author" content=peczis">

    @include('pec-cms::parts.favicons')

    <link rel="stylesheet" href="{{ mix('css/backend.css', 'vendor/pec-cms') }}" type="text/css" media="all" />
</head>
<body>
    <div id="app">
        <div class="container-fluid">
            @yield('content')
        </div><!-- container -->
    </div><!-- #app -->

    <!-- Scripts -->
    <script type="text/javascript" src="{{ mix('js/backend.js', 'vendor/pec-cms') }}"></script>
</body>
</html>