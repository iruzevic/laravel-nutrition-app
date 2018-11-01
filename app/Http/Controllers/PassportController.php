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
    $validator = Validator::make( $request->all(), $rules );

    if ( $validator->fails() ) {
      return $this->get_error_json_msg( 'error', 'validation', 'register_validation', $validator->errors() );
    }

    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input);
    $success['token'] =  $user->createToken('MyApp')->accessToken;
    $success['name'] =  $user->name;
    return $this->get_success_json_msg( $success );
  }

  /**
   * Login user and return access token.
   *
   * @return void
   */
  public function login() {
    $fields = [
      'email'    => request('email'),
      'password' => request('password')
    ];

    if ( ! Auth::attempt( $fields ) ){
        return $this->get_error_json_msg( 'error', 'unauth', 'login_unauth' );
    }

    $user = Auth::user();
    $success['token'] =  $user->createToken('MyApp')->accessToken;

    return $this->get_success_json_msg( $success );
  }

  /**
   * Get user details.
   *
   * @return json
   */
  public function getDetails() {
    $user = Auth::user();
    return $this->get_success_json_msg( $user );
  }
}
