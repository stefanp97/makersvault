<?php

namespace MakersVault;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = [
    'name', 'description',
  ];
  public function users()
  {
    return $this->belongsToMany('MakersVault\User');
  }

  public function orders()
  {
    return $this->hasMany('MakersVault\Order');
  }
}
