<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     * This is not used if you override redirectTo().
     */
    protected $redirectTo = '/dashboard';

    /**
     * Redirect users based on their role after registration.
     */
    protected function redirectTo()
    {
        if (auth()->user() && auth()->user()->is_admin) {
            return route('admin.dashboard');
        }
        return route('dashboard');
    }

    /**
     * RegisterController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validate incoming registration data.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'register_as' => ['nullable', 'in:user,admin'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $data)
    {
    // Make admin based on the registration selection (register_as)
    $isAdmin = isset($data['register_as']) && $data['register_as'] === 'admin';

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_admin' => $isAdmin,
        ]);
    }
}