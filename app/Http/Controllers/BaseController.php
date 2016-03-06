<?php

namespace MakersVault\Http\Controllers;

use Illuminate\Http\Request;

use MakersVault\Http\Requests;
use MakersVault\Product;

class BaseController extends Controller
{
    public function index()
    {
      $product = Product::where('frontpage', 1)->first();

      return view('welcome', compact('product'));
    }
}
