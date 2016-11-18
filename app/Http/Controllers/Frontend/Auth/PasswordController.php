<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Models\Access\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use PhpSpec\CodeGenerator\Generator\PrivateConstructorGenerator;
use App\Exceptions\GeneralException;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//         $this->middleware('guest');
        $this->middleware('guest',['except'=>['getChangePassword','postChangePassword']]);
    }
    
    
    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEmail()
    {
    	return view('frontend.auth.password');
    }
    
    /**
     * Display page for change user password.
     * @return \Illuminate\View\View
     */
    public function getChangePassword() {
    	return view('frontend.auth.changepassword');
    }
    
    /**
     * 
     * @param ChangePasswordRequest $request
     * @return mixed
     */
    public function postChangePassword(Request $request) {

    	$this->validate($request, [
	            'old_password' => 'required|min:6',
	            'password' => 'required|confirmed|min:6',
	        ]);

        $credentials = $request->only(
            'email', 'password', 'old_password'
        );

       $this->changePassword($request->all());
       
       //two different way to show the info.
//     sweetalert_message()->overlay(trans("strings.password_successfully_changed"),'Info');
//     return redirect('home');
              
       return redirect()->route('home')->withFlashSuccess(trans("strings.password_successfully_changed"));
    	
    }
    
    /**
     * @param $input
     * @return mixed
     * @throws GeneralException
     */
    private function changePassword($input) {
    	$user = $this->findOrThrowException(auth()->id());
    
    	if (Hash::check($input['old_password'], $user->password)) {    		
    		$user->password = bcrypt($input['password']);
    		
    		return $user->save();
    	}
    	
    	throw new GeneralException("That is not your old password.");

    }
    
    
    /**
     * @param $id
     * @return \Illuminate\Support\Collection|null|static
     * @throws GeneralException
     */
    private function findOrThrowException($id) {
    	$user = User::find($id);
    	if (! is_null($user)) return $user;
    	throw new GeneralException('That user does not exist.');

//     	return "That user does not exist.";
    }
    
    /**
     * Display the password reset view for the given token.
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function getReset($token = null)
    {
    	if (is_null($token)) {
    		throw new NotFoundHttpException;
    	}
    
    	return view('frontend.auth.reset')->with('token', $token);
    }
    
}
