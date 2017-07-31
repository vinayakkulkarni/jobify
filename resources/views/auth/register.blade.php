@extends('layouts.app')

@section('content')
<div class="sixteen wide column">
  <div class="ui padded container segment" style="margin-top: 2%">
    <form class="ui form" method="POST" action="{{ route('register') }}">
      {{ csrf_field() }}
      
      <div class="required field{{ $errors->has('name') ? ' error' : '' }}">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Email" required autofocus>
        @if ($errors->has('name'))
          <div class="ui basic red pointing prompt label transition visible">
            {{ $errors->first('name') }}
          </div>
        @endif
      </div>

      <div class="required field{{ $errors->has('email') ? ' error' : '' }}">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Email" required>
        @if ($errors->has('email'))
          <div class="ui basic red pointing prompt label transition visible">
            {{ $errors->first('email') }}
          </div>
        @endif
      </div>

      <div class="required field">
        <label>Password</label>
        <input type="password" id="password" name="password" placeholder="Password" required>
        @if ($errors->has('password'))
          <div class="ui basic red pointing prompt label transition visible">
            {{ $errors->first('password') }}
          </div>
        @endif
      </div>

      <div class="required field">
        <label>Confirm Password</label>
        <input type="password" id="password-confirm" placeholder="Repeat Password" name="password_confirmation" required>
      </div>
      <button class="ui button" type="submit">Register</button>
    </form>
  </div>
</div>
@endsection
