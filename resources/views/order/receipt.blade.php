@extends('layouts.app')

@section('content')
<section class="hero">
  <div class="row">
    <div class="small 12 columns">
      <h2>Thank you for purchasing {{ $product->name }}</h2>
    </div>
  </div>
</section>
@endsection
