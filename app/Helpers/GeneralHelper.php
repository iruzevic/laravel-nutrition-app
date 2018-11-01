<?php

namespace App\Helpers;

trait GeneralHelper {
  /**
   * Return JSON Message
   *
    * @param [type] $status
    * @param [type] $message
    * @param boolean $errors
    * @return void
    */
  protected function get_error_json_msg( $status, $code, $msg, $errors = false ) {
    
    if ( ! ( $status || $msg ) ) {
      return false;
    }

    $msg_array = array();

    if ( $status ) {
        $msg_array['status'] = $status;
    }

    if ( $code ) {
        $status_code = $this->get_json_status_codes( $code );
        $msg_array['code'] = $status_code;
    }

    if ( $msg ) {
        $msg_array['msg'] = $this->get_response_msg( $msg );
    }

    if ( $errors ) {
        $msg_array['errors'] = $errors;
    }
    
    return response()->json( [ $msg_array ], $status_code );
  }

  /**
   * Return JSON Message
   *
    * @param [type] $status
    * @param [type] $message
    * @param boolean $errors
    * @return void
    */
  protected function get_success_json_msg( $response ) {
    
    if ( ! ( $response ) ) {
      return false;
    }
    
    return response()->json( $response, $this->get_json_status_codes( 'success' ) );
  }

  protected function get_json_status_codes( $action ) {
    if ( ! $action ) {
      return false;
    }

    switch ( $action ) {
      case 'validation':
        return 422;
        break;
      case 'unauth':
        return 401;
        break;
      case 'success':
        return 200;
        break;
      default:
        return 400;
        break;
    }
  }

  protected function get_response_msg( $key ) {
    switch ( $key ) {
      case 'login_unauth':
        return 'Sorry, you are not authorized!';
        break;
      case 'register_validation':
        return 'Sorry, check your fields for validation!';
        break;
      case 'meals_store_validation':
        return 'Sorry, check your fields for validation!';
        break;
      
      default:
        return false;
        break;
    }
  }
}
