<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Helpers\GeneralHelper;
use App\Entries;

class EntriesController extends Controller {
  use GeneralHelper;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      $rules = array(
        'date'         => 'required|date_format:"Y-m-d H:i:s',
        'amount'       => 'required|numeric',
        'meals_id'     => 'required|numeric|exists:meals,id',
        'nutrients_id' => 'required|numeric|exists:nutrients,id',
      );
      $validator = Validator::make( $request->all(), $rules );

      if ( $validator->fails() ) {
        return $this->get_error_json_msg( 'validation', 'entries_validation', $validator->errors() );
      }

      $entry               = new Entries();
      $entry->user_id      = Auth::user()->id;
      $entry->date         = $request->input('date');
      $entry->amount       = $request->input('amount');
      $entry->meals_id     = $request->input('meals_id');
      $entry->nutrients_id = $request->input('nutrients_id');

      try {
        $entry->save();
      } catch ( \Illuminate\Database\QueryException $e) {
        return $this->get_error_json_msg( 'error', 'entries_save_fail', $e );
      }

      return $this->get_success_json_msg( 'entries_store_success' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
      if( ! $id ) {
        return $this->get_error_json_msg( 'validation', 'entries_id_empty' );
      }

      $entry = Entries::get_entry( $id );

      if( ! $entry ) {
        return $this->get_error_json_msg( 'not-found', 'entries_id_false' );
      }

      return $this->get_success_json_response( $entry );
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
        'date'         => 'required|date_format:"Y-m-d H:i:s',
        'amount'       => 'required|numeric',
        'meals_id'     => 'required|numeric|exists:meals,id',
        'nutrients_id' => 'required|numeric|exists:nutrients,id',
      );
      $validator = Validator::make( $request->all(), $rules );

      if ( $validator->fails() ) {
        return $this->get_error_json_msg( 'validation', 'entries_validation', $validator->errors() );
      }

      if( ! $id ) {
        return $this->get_error_json_msg( 'validation', 'entries_id_empty' );
      }

      $entry = Entries::get_entry( $id );

      if( ! $entry ) {
        return $this->get_error_json_msg( 'not-found', 'entries_id_false' );
      }

      $entry->user_id      = Auth::user()->id;
      $entry->date         = $request->input('date');
      $entry->amount       = $request->input('amount');
      $entry->meals_id     = $request->input('meals_id');
      $entry->nutrients_id = $request->input('nutrients_id');

      try {
        $entry->save();
      } catch ( \Illuminate\Database\QueryException $e) {
        return $this->get_error_json_msg( 'error', 'entries_save_fail', $e );
      }

      return $this->get_success_json_msg( 'entries_update_success' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ) {
      if ( ! $id ) {
        return $this->get_error_json_msg( 'validation', 'entries_id_empty' );
      }

      $entry = Entries::get_entry( $id );

      if ( ! $entry ) {
        return $this->get_error_json_msg( 'not-found', 'entries_id_false' );
      }

      try {
        $entry->delete();
      } catch ( \Illuminate\Database\QueryException $e) {
        return $this->get_error_json_msg( 'error', 'entries_delete_fail', $e );
      }

      return $this->get_success_json_msg( 'entries_delete_success' );
    }
}
