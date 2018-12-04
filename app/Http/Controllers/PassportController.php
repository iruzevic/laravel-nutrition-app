<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Auth;
use Validator;

class PassportController extends Controller {

  use GeneralHelper;
  
  /**
   * Register user and return access
   *
   * @param Request $request
   * @return void
   */
  public function register(Request $request) {
    $rules = array(
      'name'       => 'required',
      'email'      => 'required|email',
      'password'   => 'required',
      'c_password' => 'required|same:password',
    );
    $data = $request->json()->all();
    $validator = Validator::make( $data, $rules );

    if ( $validator->fails() ) {
      return $this->get_error_json_msg( 'validation', 'register_validation', $validator->errors() );
    }

    $data['password'] = bcrypt($data['password']);
    $user = User::create($data);
    $success['token'] =  $user->createToken('MyApp')->accessToken;
    $success['name'] =  $user->name;
    return $this->get_success_json_response( $success );
  }

  /**
   * Login user and return access token.
   *
   * @param Request $request
   * @return void
   */
  public function login(Request $request) {
    $rules = array(
      'email'      => 'required|email',
      'password'   => 'required',
    );

    $data = $request->json()->all();
    $validator = Validator::make( $data, $rules );

    if ( $validator->fails() ) {
      return $this->get_error_json_msg( 'validation', 'login_validation' );
    }

    if ( ! Auth::attempt( $data ) ){
      return $this->get_error_json_msg( 'unauth', 'login_unauth' );
    }

    $user = Auth::user();

    $success['token'] =  $user->createToken('MyApp')->accessToken;

    return $this->get_success_json_response( $success );
  }

  /**
   * Get user details.
   *
   * @return json
   */
  public function getDetails() {
    $user = Auth::user();
    return $this->get_success_json_response( $user );
  }
}
