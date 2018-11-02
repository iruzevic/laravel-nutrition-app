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
      case 'not-found':
        return 404;
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
      case 'meals_id_empty':
        return 'Meal ID not provided!';
        break;
      case 'meals_id_false':
        return 'Meal with provided id doesn\'t exist!';
        break;
      case 'meals_save_fail':
        return 'Error in saving meal entry!';
        break;
      case 'meals_delete_fail':
        return 'Error in deleting meal entry!';
        break;
      case 'meals_store_success':
        return 'Meal succesfuly created!';
        break;
      case 'meals_update_success':
        return 'Meal succesfuly updated!';
        break;
      case 'meals_delete_success':
        return 'Meal succesfuly deleted!';
        break;

      case 'entries_validation':
        return 'Sorry, check your entries fields for validation!';
        break;
      case 'entries_id_empty':
        return 'Entry ID not provided!';
        break;
      case 'entries_id_false':
        return 'Entry with provided id doesn\'t exist!';
        break;
      case 'entries_save_fail':
        return 'Error in saving entry!';
        break;
      case 'entries_delete_fail':
        return 'Error in deleting entry!';
        break;
      case 'entries_store_success':
        return 'Entry succesfuly created!';
        break;
      case 'entries_update_success':
        return 'Entry succesfuly updated!';
        break;
      case 'entries_delete_success':
        return 'Entry succesfuly deleted!';
        break;

      case 'nutrients_validation':
        return 'Sorry, check your nutrients fields for validation!';
        break;
      case 'nutrients_id_empty':
        return 'Nutrient ID not provided!';
        break;
      case 'nutrients_id_false':
        return 'Nutrient with provided id doesn\'t exist!';
        break;
      case 'nutrients_save_fail':
        return 'Error in saving nutrients!';
        break;
      case 'nutrients_delete_fail':
        return 'Error in deleting nutrients!';
        break;
      case 'nutrients_store_success':
        return 'Nutrient succesfuly created!';
        break;
      case 'nutrients_update_success':
        return 'Nutrient succesfuly updated!';
        break;
      case 'nutrients_delete_success':
        return 'Nutrient succesfuly deleted!';
        break;

      case 'nutrients_type_validation':
        return 'Sorry, check your nutrients type fields for validation!';
        break;
      case 'nutrients_type_id_empty':
        return 'Nutrient type ID not provided!';
        break;
      case 'nutrients_type_id_false':
        return 'Nutrient type with provided id doesn\'t exist!';
        break;
      case 'nutrients_type_save_fail':
        return 'Error in saving nutrients type!';
        break;
      case 'nutrients_type_delete_fail':
        return 'Error in deleting nutrients type!';
        break;
      case 'nutrients_type_store_success':
        return 'Nutrient type succesfuly created!';
        break;
      case 'nutrients_type_update_success':
        return 'Nutrient type succesfuly updated!';
        break;
      case 'nutrients_type_delete_success':
        return 'Nutrient type succesfuly deleted!';
        break;
      
      case 'users_details_validation':
        return 'Sorry, check your users details fields for validation!';
        break;
      case 'users_details_id_empty':
        return 'Users details ID not provided!';
        break;
      case 'users_details_id_false':
        return 'Users details with provided id doesn\'t exist!';
        break;
      case 'users_details_save_fail':
        return 'Error in saving users details entry!';
        break;
      case 'users_details_delete_fail':
        return 'Error in deleting users details entry!';
        break;
      case 'users_details_store_success':
        return 'Users details succesfuly created!';
        break;
      case 'users_details_update_success':
        return 'Users details succesfuly updated!';
        break;
      case 'users_details_delete_success':
        return 'Users details succesfuly deleted!';
        break;

      default:
        return false;
        break;
    }
  }
}
