@extends('layouts.app') 

@section('content')

<div class="sixteen wide column">
  <div class="ui padded container segment" style="margin-top: 5%">
    <form class="ui form" method="POST" action="{{ route('login') }}">
      {{ csrf_field() }}
      
      <div class="field{{ $errors->has('email') ? ' error' : '' }}">
        <label for="email">E-Mail Address</label>
        <input type="email" name="email" placeholder="Email">
        @if ($errors->has('email'))
          <div class="ui basic red pointing prompt label transition visible">
            {{ $errors->first('email') }}
          </div>
        @endif
      </div>

      <div class="field">
        <label>Password</label>
        <input id="password" type="password" name="password" placeholder="Password" required>
        @if ($errors->has('password'))
          <div class="ui basic red pointing prompt label transition visible">
            {{ $errors->first('password') }}
          </div>
        @endif
      </div>

      <div class="field">
        <div class="ui checkbox">
          <input type="checkbox" name="remember" tabindex="0" class="hidden" {{ old( 'remember') ? 'checked' : '' }}>
          <label>Remember Me</label>
        </div>
      </div>

      <button class="ui primary button" type="submit">Submit</button>
      <a href="{{ route('password.request') }}"> Forgot Your Password? </a>
    </form>
  </div>
</div>

@endsection
