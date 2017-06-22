<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $username = 'mobile';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function username()
    {
            return 'mobile';
    }   
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'mobile' => 'required|numeric|unique:users',
            'password' => 'required|min:6|confirmed',
            'shop_en_name' => 'required|max:255',
            'shop_ar_name' => 'required|max:255',
            'address' => 'required',
            'typeOfService' => 'required',
            'n_w_hours' => 'required',
            'activeStatues' =>'required',
            'logo' => 'required',
            
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

        $user =  User::create([
            'mobile' => $data['mobile'],
            'password' => bcrypt($data['password']),
            'role' => 2,
        ]);
        return $user;
    }
}
