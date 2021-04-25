<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
		            |--------------------------------------------------------------------------
		            | Register Controller
		            |--------------------------------------------------------------------------
		            |
		            | This controller handles the registration of new users as well as their
		            | validation and creation. By default this controller uses a trait to
		            | provide this functionality without requiring any additional code.
		            |
	*/

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)

    {
        // dd($data);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'cargo' => $data['cargo'],
            'hospital_id' => $data['hospital_id'],
            'password' => bcrypt($data['password']),
        ]);
        $user
            ->roles()
            ->attach($data['rol']);

        // dd($user);
        return $user;
    }

    protected function showRegistrationForm(Request $request)
    {
        $hospital = auth()->user()->hospital->id;
        $roles = \App\Role::all();
        $hospitales = \App\Hospital::all();
        $param = [$roles, $hospitales, $hospital];
        if ($request->user()->authorizeRoles('user')) {
            return view('homeUser');
        }
        if ($request->user()->authorizeRoles('admin')) {
            return view("auth.register", compact('param'));
        }
        if ($request->user()->authorizeRoles('superadmin')) {
            return view("auth.registerSuper", compact('param'));
        }
    }

    protected function showSuperRegistrationForm(Request $request)
    {
        $roles = \App\Role::all();
        $hospitales = \App\Hospital::all();
        $param = [$roles, $hospitales];
        // dd($param);
        if ($request->user()->authorizeRoles('user')) {
            return view('homeUser');
        }
        if ($request->user()->authorizeRoles('admin')) {
            return view("homeAdmin");
        }
        if ($request->user()->authorizeRoles('superadmin')) {
            return view("auth.registerSuper", compact('param'));
        }
    }
}
