@extends('layouts.app')

@section('headScripts')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
@endsection

@section('content')
<section class="home">
    <div class="row">
      @include('partials/errors')
        <div class="small-12 columns">
            @if(Auth::check())
                <h3 class="text-center">Hi, {{ Auth::user()->first_name }}</h3>
            @endif
            <h2 class="text-center">{{ $product->name }}</h2>
        </div>
        <div class="small-12 large-8 columns">
            <img src="http://placehold.it/800x600">
            <p>{{ $product->description }}</p>
            <form action="/order" id="payment-form" method="post" class="callout" accept-charset="utf-8">
                {!! csrf_field() !!}
                <div class="payment-errors"></div>
                <div class="row">
                    <div class="small-12 large-6 columns">
                        <label for="first_name">First Name
                            <input type="text" name="first_name" id="first_name" required>
                        </label>
                    </div>
                    <div class="small-12 large-6 columns">
                        <label for="last_name">Last Name
                            <input type="text" name="last_name" id="last_name" required>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                        <label for="email">Email
                            <input type="email" name="email" id="email">
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 large-6 columns">
                        <label for="card_number">Card Number <i class="fa fa-cc-discover"></i> <i class="fa fa-cc-visa"></i> <i class="fa fa-cc-mastercard"></i> <i class="fa fa-cc-amex"></i></label>
                        <input type="number" data-stripe="number" class="card-number radius" value={{ old('number') }} required>
                        <p class="help-text">Visa, Mastercard, American Express, and Discover are accepted. Payments are processed securely through <a href="http://stripe.com">Stripe.com</a>.</p>
                    </div>
                    <div class="small-12 large-3 columns">
                        <label for="cvc">CVC</label>
                        <input type="number" data-stripe="cvc" class="card-cvc radius" required>
                        <p class="help-text">3-4 digit number on the back of the card.</p>
                    </div>
                    <div class="small-12 large-3 columns">
                        <label for="zip">Zip code</label>
                        <input type="text" data-stripe="address-zip" class="address-zip radius" required>
                    </div>
                 </div>
                 <div class="row">
                    <div class="small-6 columns">
                        <label for="exp-month">Expiration (MM/YYYY)</label>
                        <select id="exp-month" class="card-expiry-month radius" data-stripe="exp-month">
                            <option value="01" @if (\Carbon\Carbon::now()->month == '1') selected @endif>01</option>
                            <option value="02" @if (\Carbon\Carbon::now()->month == '2') selected @endif>02</option>
                            <option value="03" @if (\Carbon\Carbon::now()->month == '3') selected @endif>03</option>
                            <option value="04" @if (\Carbon\Carbon::now()->month == '4') selected @endif>04</option>
                            <option value="05" @if (\Carbon\Carbon::now()->month == '5') selected @endif>05</option>
                            <option value="06" @if (\Carbon\Carbon::now()->month == '6') selected @endif>06</option>
                            <option value="07" @if (\Carbon\Carbon::now()->month == '7') selected @endif>07</option>
                            <option value="08" @if (\Carbon\Carbon::now()->month == '8') selected @endif>08</option>
                            <option value="09" @if (\Carbon\Carbon::now()->month == '9') selected @endif>09</option>
                            <option value="10" @if (\Carbon\Carbon::now()->month == '10') selected @endif>10</option>
                            <option value="11" @if (\Carbon\Carbon::now()->month == '11') selected @endif>11</option>
                            <option value="12" @if (\Carbon\Carbon::now()->month == '12') selected @endif>12</option>
                        </select>
                    </div>
                    <div class="small-6 columns">
                        <label>&nbsp;</label>
                        <select id="exp-yr" class="card-expiry-year radius" data-stripe="exp-year">
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="row">
                    <div class="small-12 columns">
                        <button type="submit" class="submit-button button clear large expanded">Purchase for $29</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="small-12 large-4 columns">
            <div class="callout">
                <p>Maker: Stefan</p>
            </div>
            @if(Auth::check())
                <ul>
                    @foreach(Auth::user()->products as $product)
                        <li>{{ $product->name }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</section>
@endsection

@section('footScripts')
<script type="text/javascript">
    // This identifies your website in the createToken call below
    Stripe.setPublishableKey('{{ env('STRIPE_KEY') }}');
    // ...
    jQuery(function($) {
      $('#payment-form').submit(function(event) {
        var $form = $(this);
        // Disable the submit button to prevent repeated clicks
        $form.find('.submit-button').prop('disabled', true);
        Stripe.card.createToken($form, stripeResponseHandler);
        // Prevent the form from submitting with the default action
        return false;
      });
    });
    function stripeResponseHandler(status, response) {
      var $form = $('#payment-form');
      if (response.error) {
        // Show the errors on the form
        $form.find('.payment-errors').text(response.error.message);
        $form.find('.submit-button').prop('disabled', false);
      } else {
        // response contains id and card, which contains additional card details
        var token = response.id;
        // Insert the token into the form so it gets submitted to the server
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));
        // and submit
        $form.get(0).submit();
      }
    };
</script>
@endsection
