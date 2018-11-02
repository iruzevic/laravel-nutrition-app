<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Helpers\GeneralHelper;
use App\UsersDetails;

class UsersDetailsController extends Controller {
  use GeneralHelper;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
      $rules = array(
        'calories_baseline' => 'required|numeric',
        'calories_goal'     => 'required|numeric',
        'age'               => 'required|numeric',
        'gender'            => 'required|string',
        'weight'            => 'required|numeric',
        'height'            => 'required|numeric',
      );
      $validator = Validator::make( $request->all(), $rules );

      if ( $validator->fails() ) {
        return $this->get_error_json_msg( 'validation', 'users_details_validation', $validator->errors() );
      }

      $user_detail                    = new UsersDetails();
      $user_detail->user_id           = Auth::user()->id;
      $user_detail->calories_baseline = $request->input('calories_baseline');
      $user_detail->calories_goal     = $request->input('calories_goal');
      $user_detail->age               = $request->input('age');
      $user_detail->gender            = $request->input('gender');
      $user_detail->weight            = $request->input('weight');
      $user_detail->height            = $request->input('height');

      try {
        $user_detail->save();
      } catch ( \Illuminate\Database\QueryException $e) {
        return $this->get_error_json_msg( 'error', 'users_details_save_fail', $e );
      }

      return $this->get_success_json_msg( 'users_details_store_success' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
      if( ! $id ) {
        return $this->get_error_json_msg( 'validation', 'users_details_id_empty' );
      }

      $user_detail = UsersDetails::get_users_detail( $id );

      if( ! $user_detail ) {
        return $this->get_error_json_msg( 'not-found', 'users_details_id_false' );
      }

      return $this->get_success_json_response( $user_detail );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
      $rules = array(
        'calories_baseline' => 'required|numeric',
        'calories_goal'     => 'required|numeric',
        'age'               => 'required|numeric',
        'gender'            => 'required|string',
        'weight'            => 'required|numeric',
        'height'            => 'required|numeric',
      );
      $validator = Validator::make( $request->all(), $rules );

      if ( $validator->fails() ) {
        return $this->get_error_json_msg( 'validation', 'users_details_validation', $validator->errors() );
      }

      if( ! $id ) {
        return $this->get_error_json_msg( 'validation', 'users_details_id_empty' );
      }

      $user_detail = UsersDetails::get_users_detail( $id );

      if( ! $user_detail ) {
        return $this->get_error_json_msg( 'not-found', 'users_details_id_false' );
      }

      $user_detail->user_id           = Auth::user()->id;
      $user_detail->calories_baseline = $request->input('calories_baseline');
      $user_detail->calories_goal     = $request->input('calories_goal');
      $user_detail->age               = $request->input('age');
      $user_detail->gender            = $request->input('gender');
      $user_detail->weight            = $request->input('weight');
      $user_detail->height            = $request->input('height');

      try {
        $user_detail->save();
      } catch ( \Illuminate\Database\QueryException $e) {
        return $this->get_error_json_msg( 'error', 'users_details_save_fail', $e );
      }

      return $this->get_success_json_msg( 'users_details_update_success' );
    }
}
