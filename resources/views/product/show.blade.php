@extends('layouts.app')

@section('content')
<section class="home">
  <div class="row">
    <div class="small-12 columns">
      <h2 class="text-center">{{ $product->name }}</h2>
    </div>
    <div class="small-12 large-8 columns">
      <img src="http://placehold.it/800x600" alt="" />
      <p>
        {{ $product->description }}
      </p>
      <div class="">
        <a href="#" class="button expanded">Purchase for 30$</a>
      </div>
    </div>
    <div class="small-12 large-4 columns">
      <div class="callout">
        <p>Maker: Stefan</p>
      </div>
    </div>
  </div>
</section>
@endsection
