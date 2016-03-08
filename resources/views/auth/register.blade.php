@extends('layouts.app')

@section('content')
<section class="first-section">
    <div class="row">
        <div class="small-12 columns text-center">
            <h2>Sign Up</h2>
        </div>
    </div>
</section>
<section class="product">
    <div class="row">
        <div class="small-12 large-6 large-offset-3 columns end">
            <form method="post" action="/register" class="callout">
                @include('partials.errors')
                {!! csrf_field() !!}
                <div class="row">
                    <div class="small-12 columns">
                        <label for="email">Email</label>
                        <input class="radius" name="email" type="email" id="email">
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 large-6 columns">
                        <label for="first_name">First Name</label>
                        <input class="radius" name="first_name" type="text" id="first_name">
                    </div>
                    <div class="small-12 large-6 columns">
                        <label for="last_name">Last Name</label>
                        <input class="radius" name="last_name" type="text" id="last_name">
                    </div>
                </div>

                <label for="password">Password</label>
                <input class="radius" name="password" type="password" value="" id="password">
                <button type="submit" class="button expanded">Sign Me Up</button>
            </form>
        </div>
    </div>
</section>
@endsection
