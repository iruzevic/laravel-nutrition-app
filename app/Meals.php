<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Meals extends Model
{
  protected $fillable = [
    'user_id',
    'name',
    'created_at'
];

  protected $hidden = [
      'user_id'
  ];

  protected static function get_meals( $id ) 
  {
    return
        Meals::select('*')
        ->where('user_id', Auth::user()->id)
        ->where('id', $id)
        ->first();
  }
}
