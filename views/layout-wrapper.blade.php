<!doctype html>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Epistolary - @yield('title')</title>

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <style>
      body { padding-bottom: 60px; }
    </style>

    @stack('styles')

  </head>
  <body>

    <!-- Main content -->
    @yield('content')

    @yield('scripts')
    @stack('scripts')

  </body>
</html>
