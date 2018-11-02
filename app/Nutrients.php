<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Nutrients extends Model {
  protected $fillable = [
    'user_id',
    'name',
    'brand',
    'unit',
    'calories',
    'carb',
    'protein',
    'fat',
    'sugar',
    'nutrients_type_id',
    'created_at'
  ];

  protected $hidden = [
      'user_id'
  ];

  protected static function get_nutrient( $id )  {
    return
      Nutrients::select('*')
        ->where('user_id', Auth::user()->id)
        ->where('id', $id)
        ->first();
  }

  protected static function get_nutrients()  {
    return
      Nutrients::select('*')
        ->where('user_id', Auth::user()->id);
  }
}
