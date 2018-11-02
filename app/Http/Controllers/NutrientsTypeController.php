<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Helpers\GeneralHelper;
use App\NutrientsTypes;

class NutrientsTypesController extends Controller {
  use GeneralHelper;

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store( Request $request ) {
    $rules = array(
      'name'   => 'required',
    );
    $validator = Validator::make( $request->all(), $rules );

    if ( $validator->fails() ) {
      return $this->get_error_json_msg( 'validation', 'nutrients_type_validation', $validator->errors() );
    }

    $nutrients_type          = new NutrientsTypes();
    $nutrients_type->user_id = Auth::user()->id;
    $nutrients_type->name    = $request->input('name');

    try {
      $nutrients_type->save();
    } catch ( \Illuminate\Database\QueryException $e) {
      return $this->get_error_json_msg( 'error', 'nutrients_type_save_fail', $e );
    }

    return $this->get_success_json_msg( 'nutrients_type_store_success' );
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show( $id ) {
    if( ! $id ) {
      return $this->get_error_json_msg( 'validation', 'nutrients_type_id_empty' );
    }

    $nutrients_type = NutrientsTypes::get_nutrients_type( $id );

    if( ! $nutrients_type ) {
      return $this->get_error_json_msg( 'not-found', 'nutrients_type_id_false' );
    }

    return $this->get_success_json_response( $nutrients_type );
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
      'name'   => 'required',
    );
    $validator = Validator::make( $request->all(), $rules );

    if ( $validator->fails() ) {
      return $this->get_error_json_msg( 'validation', 'nutrients_type_validation', $validator->errors() );
    }

    if( ! $id ) {
      return $this->get_error_json_msg( 'validation', 'nutrients_type_id_empty' );
    }

    $nutrients_type = NutrientsTypes::get_nutrients_type( $id );

    if( ! $nutrients_type ) {
      return $this->get_error_json_msg( 'not-found', 'nutrients_type_id_false' );
    }

    $nutrients_type->user_id = Auth::user()->id;
    $nutrients_type->name    = $request->input('name');

    try {
      $nutrients_type->save();
    } catch ( \Illuminate\Database\QueryException $e) {
      return $this->get_error_json_msg( 'error', 'nutrients_type_save_fail', $e );
    }

    return $this->get_success_json_msg( 'nutrients_type_update_success' );
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    if( ! $id ) {
      return $this->get_error_json_msg( 'validation', 'nutrients_type_id_empty' );
    }

    $nutrients_type = NutrientsTypes::get_nutrients_type( $id );

    if( ! $nutrients_type ) {
      return $this->get_error_json_msg( 'not-found', 'nutrients_type_id_false' );
    }

    try {
      $nutrients_type->delete();
    } catch ( \Illuminate\Database\QueryException $e) {
      return $this->get_error_json_msg( 'error', 'nutrients_type_delete_fail', $e );
    }

    return $this->get_success_json_msg( 'nutrients_type_delete_success' );
  }
}
