@extends('layouts.app')

@section('content')
<div class="sixteen wide column">
  <div class="ui padded container segment" style="margin-top: 5%">
    <h4 class="ui header">Reset Password</h4>
    <form class="ui form" method="POST" action="{{ route('password.email') }}">
      {{ csrf_field() }}

      @if (session('status'))
        <div class="ui positive message">
          {{ session('status') }}
        </div>
      @endif
      
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
        <button class="ui primary button" type="submit">Send Password Reset Link</button>
      </div>
    </form>
  </div>
</div>
@endsection
