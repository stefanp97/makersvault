<?php

namespace MakersVault;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = [
    'user_id', 'product_id', 'amount', 'payment_method',
  ];

    public function user()
    {
      return $this->belongsTo('MakersVault\User');
    }
    public function product()
    {
      return $this->belongsTo('MakersVault\Product');
    }
}
