<?php

namespace App\Http\Controllers\Frontend\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Access\User\Users;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *auth.login
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }
    
    public function getLogin()
    {
    	if (view()->exists('auth.authenticate')) {
    		return view('auth.authenticate');
    	}
    
    	return view('frontend.auth.login');
    }
    
    /**
     * @return \Illuminate\View\View
     */
    public function getRegister()
    {
    	return view('frontend.auth.register');
    }
    
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
    	$validator = $this->validator($request->all());
    
    	if ($validator->fails()) {
    		$this->throwValidationException(
    				$request, $validator
    		);
    	}
    	
//     	dd($request->all());
    
    	Auth::login($this->create($request->all()));
//     	return redirect($this->redirectPath());
    	return redirect()->route('home.quickorder')->with('regist', true);;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
        	'phone' => ['required','regex:/^(?!64)\d{9,11}/'],
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return Users::create([
            'name' => $data['name'],
            'email' => $data['email'],
        	'phone'=>$data['phone'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
