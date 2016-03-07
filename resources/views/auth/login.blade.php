
@extends('layouts.app')

@section('content')
<section class="first-section">
    <div class="row">
        <div class="small-12">
            <h2 class="text-center">Login</h2>
        </div>
    </div>
</section>
<section class="gray">
    <div class="row">
        <div class="small-12 medium-6 medium-offset-3 columns">
            <form method="POST" action="/login" accept-charset="UTF-8" class="callout clear">
                {!! csrf_field() !!}
                <div class="row">
                    <div class="large-6 columns">
                        <label for="email">Email</label>
                        <input class="radius" name="email" type="email" id="email">
                    </div>
                    <div class="large-6 columns">
                        <label for="password">Password</label>
                        <input class="radius" name="password" type="password" value="" id="password">
                    </div>
                </div>
                <div class="row">
                    <div class="large-6 columns">
                        <input name="remember" type="checkbox" value="1"> Remember Me<br>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                        <input class="button  expanded" type="submit" value="Login">
                    </div>
                </div>
            </form>
            <p class="text-center">Forget your password or it isn&rsquo;t working? <a href="/password/reset">You might need to reset it.</a></p>
        </div>
    </div>
</section>
@endsection
