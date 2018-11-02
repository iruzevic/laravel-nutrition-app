<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Helpers\GeneralHelper;
use App\Meals;

class MealsController extends Controller {
  use GeneralHelper;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $rules = array(
        'name'   => 'required',
      );
      $validator = Validator::make( $request->all(), $rules );

      if ( $validator->fails() ) {
        return $this->get_error_json_msg( 'validation', 'meals_validation', $validator->errors() );
      }

      $meals          = new Meals();
      $meals->user_id = Auth::user()->id;
      $meals->name    = $request->input('name');

      try {
        $meals->save();
      } catch ( \Illuminate\Database\QueryException $e) {
        return $this->get_error_json_msg( 'error', 'meals_save_fail', $e );
      }

      return $this->get_success_json_msg( 'meals_store_success' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $rules = array(
        'name'   => 'required',
      );
      $validator = Validator::make( $request->all(), $rules );

      if ( $validator->fails() ) {
        return $this->get_error_json_msg( 'validation', 'meals_validation', $validator->errors() );
      }

      if( ! $id ) {
        return $this->get_error_json_msg( 'validation', 'meals_id_empty' );
      }

      $meals = Meals::get_meals( $id );

      if( ! $meals ) {
        return $this->get_error_json_msg( 'error', 'meals_id_false' );
      }

      $meals->user_id = Auth::user()->id;
      $meals->name    = $request->input('name');

      try {
        $meals->save();
      } catch ( \Illuminate\Database\QueryException $e) {
        return $this->get_error_json_msg( 'error', 'meals_save_fail', $e );
      }

      return $this->get_success_json_msg( 'meals_update_success' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
