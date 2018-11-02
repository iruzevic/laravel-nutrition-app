<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Helpers\GeneralHelper;
use App\Nutrients;

class NutrientsController extends Controller {
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
  public function store(Request $request) {
    $rules = array(
      'name'               => 'required',
      'brand'              => 'required',
      'unit'               => 'required|numeric',
      'calories'           => 'required|numeric',
      'carb'               => 'required|numeric',
      'protein'            => 'required|numeric',
      'fat'                => 'required|numeric',
      'sugar'              => 'required|numeric',
      'nutrients_types_id' => 'required|numeric|exists:nutrients_types,id',
    );
    $validator = Validator::make( $request->all(), $rules );

    if ( $validator->fails() ) {
      return $this->get_error_json_msg( 'validation', 'nutrients_validation', $validator->errors() );
    }

    $nutrient                     = new Nutrients();
    $nutrient->user_id            = Auth::user()->id;
    $nutrient->name               = $request->input('name');
    $nutrient->brand              = $request->input('brand');
    $nutrient->unit               = $request->input('unit');
    $nutrient->calories           = $request->input('calories');
    $nutrient->carb               = $request->input('carb');
    $nutrient->protein            = $request->input('protein');
    $nutrient->fat                = $request->input('fat');
    $nutrient->sugar              = $request->input('sugar');
    $nutrient->nutrients_types_id = $request->input('nutrients_types_id');

    try {
      $nutrient->save();
    } catch ( \Illuminate\Database\QueryException $e) {
      return $this->get_error_json_msg( 'error', 'nutrients_save_fail', $e );
    }

    return $this->get_success_json_msg( 'nutrients_store_success' );
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show( $id ) {
    if( ! $id ) {
      return $this->get_error_json_msg( 'validation', 'nutrients_id_empty' );
    }

    $nutrient = Nutrients::get_nutrient( $id );

    if( ! $nutrient ) {
      return $this->get_error_json_msg( 'not-found', 'nutrients_id_false' );
    }

    return $this->get_success_json_response( $nutrient );
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
      'name'               => 'required',
      'brand'              => 'required',
      'unit'               => 'required|numeric',
      'calories'           => 'required|numeric',
      'carb'               => 'required|numeric',
      'protein'            => 'required|numeric',
      'fat'                => 'required|numeric',
      'sugar'              => 'required|numeric',
      'nutrients_types_id' => 'required|numeric|exists:nutrients_types,id',
    );
    $validator = Validator::make( $request->all(), $rules );

    if ( $validator->fails() ) {
      return $this->get_error_json_msg( 'validation', 'nutrients_validation', $validator->errors() );
    }

    if( ! $id ) {
      return $this->get_error_json_msg( 'validation', 'nutrients_id_empty' );
    }

    $nutrient = Nutrients::get_nutrient( $id );

    if( ! $nutrient ) {
      return $this->get_error_json_msg( 'not-found', 'nutrients_id_false' );
    }

    $nutrient->user_id            = Auth::user()->id;
    $nutrient->name               = $request->input('name');
    $nutrient->brand              = $request->input('brand');
    $nutrient->unit               = $request->input('unit');
    $nutrient->calories           = $request->input('calories');
    $nutrient->carb               = $request->input('carb');
    $nutrient->protein            = $request->input('protein');
    $nutrient->fat                = $request->input('fat');
    $nutrient->sugar              = $request->input('sugar');
    $nutrient->nutrients_types_id = $request->input('nutrients_types_id');

    try {
      $nutrient->save();
    } catch ( \Illuminate\Database\QueryException $e) {
      return $this->get_error_json_msg( 'error', 'nutrients_save_fail', $e );
    }

    return $this->get_success_json_msg( 'nutrients_update_success' );
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy( $id ) {
    if ( ! $id ) {
      return $this->get_error_json_msg( 'validation', 'nutrients_id_empty' );
    }

    $nutrient = Nutrients::get_nutrient( $id );

    if ( ! $nutrient ) {
      return $this->get_error_json_msg( 'not-found', 'nutrients_id_false' );
    }

    try {
      $nutrient->delete();
    } catch ( \Illuminate\Database\QueryException $e) {
      return $this->get_error_json_msg( 'error', 'nutrients_delete_fail', $e );
    }

    return $this->get_success_json_msg( 'nutrients_delete_success' );
  }
}
