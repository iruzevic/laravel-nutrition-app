<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class NutrientsTypes extends Model {
  protected $fillable = [
    'user_id',
    'name',
    'created_at'
  ];

  protected $hidden = [
      'user_id'
  ];

  protected static function get_nutrients_type( $id )  {
    return
        NutrientsTypes::select('*')
        ->where('user_id', Auth::user()->id)
        ->where('id', $id)
        ->first();
  }

  // protected static function get_nutrients_types()  {
  //   return
  //       NutrientsTypes::select('*')
  //       ->where('user_id', Auth::user()->id);
  // }
}
