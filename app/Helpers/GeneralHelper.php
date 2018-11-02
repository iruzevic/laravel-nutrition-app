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
  protected function get_error_json_msg( $code, $msg, $errors = false ) {
    if ( ! ( $msg || $code ) ) {
      return false;
    }

    $status_code = $this->get_json_status_codes( $code );

    $error_output = array(
      'status' => 'error',
      'code'   => $status_code,
      'msg'    => $this->get_response_msg( $msg ),
      'errors' => $errors,
    );

    return response()->json( $error_output, $status_code );
  }

  /**
   * Return JSON Message
   *
    * @param [type] $status
    * @param [type] $message
    * @param boolean $errors
    * @return void
    */
  protected function get_success_json_msg( $msg ) {
    if ( ! $msg ) {
      return false;
    }

    $status_code = $this->get_json_status_codes( 'success' );

    $success_output = array(
      'status' => 'success',
      'code'   => $status_code,
      'msg'    => $this->get_response_msg( $msg ),
    );

    
    return response()->json( $success_output, $status_code );
  }

  /**
   * Return JSON Message
   *
    * @param [type] $status
    * @param [type] $message
    * @param boolean $errors
    * @return void
    */
  protected function get_success_json_response( $response ) {
    
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
      case 'error':
        return 400;
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
        return 'Sorry, check your registration fields for validation!';
        break;
      case 'meals_validation':
        return 'Sorry, check your meals fields for validation!';
        break;
      case 'meals_save_fail':
        return 'Error in saving meal entry!';
        break;
      case 'meals_store_success':
        return 'Meal succesfuly created!';
        break;
      case 'meals_id_empty':
        return 'Meal ID not provided!';
        break;
      case 'meals_id_false':
        return 'Meal with provided id doesn\'t exist!';
        break;
      case 'meals_update_success':
        return 'Meal succesfuly updated!';
        break;
      
      default:
        return false;
        break;
    }
  }
}
