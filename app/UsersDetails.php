<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UsersDetails extends Model {

  protected $fillable = [
    'user_id',
    'calories_baseline',
    'calories_goal',
    'age',
    'gender',
    'weight',
    'height',
    'created_at'
  ];

  protected $hidden = [
      'user_id'
  ];

  protected static function get_users_detail( $id )  {
    return
        UsersDetails::select('*')
        ->where('user_id', Auth::user()->id)
        ->where('id', $id)
        ->first();
  }
}
