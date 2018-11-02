<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Entries extends Model {
  protected $fillable = [
    'user_id',
    'date',
    'amount',
    'meals_id',
    'nutrients_id',
    'created_at'
  ];

  protected $hidden = [
      'user_id'
  ];

  protected static function get_entry( $id )  {
    return
      Entries::select('*')
        ->where('user_id', Auth::user()->id)
        ->where('id', $id)
        ->first();
  }

  protected static function get_entries()  {
    return
      Entries::select('*')
        ->where('user_id', Auth::user()->id);
  }
}
