<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jobify :: Dashboard</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('assets/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ mix('assets/css/app.css') }}">
    <script src="{{ mix('assets/js/manifest.js') }}"></script>
    <script src="{{ mix('assets/js/vendor.js') }}"></script>
    <script src="{{ mix('assets/js/app.js') }}"></script>
    <!-- Styles -->
    <style>
        html, body {
          background: linear-gradient(12deg,#bb40d4,#111b5c) no-repeat 50% fixed;
          background-size: cover;
          color: #636b6f;
          font-family: 'Raleway', sans-serif;
          font-weight: 100;
          height: 100vh;
          margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center !important;
            display: flex !important;
            justify-content: center !important;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .m-b-md {
            margin-bottom: 30px;
            color: #eee;
            text-shadow: 0 0.05em rgba(0,0,0,.17), 0 0.1em 0.25em rgba(0,0,0,.25);
            font-weight: 900;
            background-position: 50% 50%;
            background-size: 95vw 80vw;
        }
    </style>
  </head>
  <body>
    <div class="flex-center position-ref full-height">
      @if (Route::has('login'))
        <div class="top-right links">
          @if (Auth::check())
            <div class="ui basic large inverted buttons">
              <!-- WIP to add users logged in can check their submitted applications -->
              <!-- <a class="ui button" href="{{ url('/jobs') }}">View My Applications</a> -->
              <a class="ui button href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </div>
          @else
            <div class="ui basic large inverted buttons">
              <a class="ui button" href="{{ url('/login') }}">Login</a>
              <a class="ui button" href="{{ url('/register') }}">Register</a>
            </div>
          @endif
        </div>
      @endif
      <div class="content">
        <div class="title m-b-md">Jobify</div>
        <div class="ui basic large inverted buttons" style="margin-top:20px;">
          <a class="ui button" href="{{ url('/jobs') }}">Jobs</a>
          <a class="ui button" href="{{ url('/applications') }}">Applications</a>
        </div>
      </div>
    </div>
  </body>
</html>
