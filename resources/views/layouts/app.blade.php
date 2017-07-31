<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Jobify') }}</title>
  <!-- Styles -->
  <link rel="stylesheet" href="{{ mix('assets/css/vendor.css') }}">
  <link rel="stylesheet" href="{{ mix('assets/css/app.css') }}">
  <!-- Scripts -->
  <script src="{{ mix('assets/js/manifest.js') }}"></script>
  <script src="{{ mix('assets/js/vendor.js') }}"></script>
  <script src="{{ mix('assets/js/app.js') }}"></script>
  <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer></script>
  <script>
  window.Jobify = <?php echo json_encode([
          'csrfToken' => csrf_token()
      ]); ?>
  </script>
</head>

<body>
  <div id="app">
    <div class="ui top fixed inverted menu">
      <a class="item menu-trigger" href="{{ url('/') }}">{{ config('app.name', 'Jobify') }}</a>
      <div class="right menu">
        @if (Auth::guest())
          <a class="item" href="{{ route('login') }}">Login</a>
          <a class="item" href="{{ route('register') }}">Register</a>
        @else
        <a class="item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
        @endif
      </div>
    </div>
      @yield('content')
    <!-- <div class="ui bottom fixed inverted one item menu">
      <p class="item">A simple jobs board app built with ❤ and JavaScript</p>
    </div> -->
  </div>
</body>

</html>
