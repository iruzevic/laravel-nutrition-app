<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Helpers\GeneralHelper;

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
        'category'      => 'required|numeric',
        'account'       => 'required|numeric',
        'description'   => 'required',
        'amount'        => 'required|numeric',
        'created_at'    => 'required|date_format:"d-m-Y"'
      );
      $validator = Validator::make( $request->all(), $rules );

      if ( $validator->fails() ) {
        return $this->get_error_json_msg( 'error', 'validation', 'meals_store_validation', $validator->errors() );
      }

      $user = Auth::user();
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
        //
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
