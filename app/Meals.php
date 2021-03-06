<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Meals extends Model {
  protected $fillable = [
    'user_id',
    'name',
    'created_at'
  ];

  protected $hidden = [
      'user_id'
  ];

  protected static function get_meal( $id )  {
    return
        Meals::select('*')
        ->where('user_id', Auth::user()->id)
        ->where('id', $id)
        ->first();
  }

  protected static function get_meals()  {
    return
        Meals::select('*')
        ->where('user_id', Auth::user()->id);
  }
}
