<?php

namespace App\Http\Controllers\Auth;

use App\Enums\AuthEnums;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(AuthRequest $request)
    {

        $user = AuthRepository::storeByRequest($request);
        $user->assignRole(AuthEnums::USER->value);
        return to_route('login')->withSuccess('User register successfully');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|email:rfc,dns|exists:users,email',
            'password' => 'required|min:6'
        ]);

        $user = User::where('email', $request->email)
            ->where('password', Hash::make($request->password))
            ->first();

        if (!$user && Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
        }

        if ($user && $user->hasRole(AuthEnums::USER->value)) {
            Auth::login($user);
            return to_route('root')->withSuccess('Login successfully');
        }
    }


    // public function postLogin(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|exists:users,email',
    //         'password' => 'required|min:6'
    //     ]);

    //     if (Auth::attempt($request->only('email', 'password'))) {
    //         $user = Auth::user();

    //         if ($user->hasRole(AuthEnums::USER->value)) {
    //             return to_route('root')->withSuccess('Login successfully');
    //         }

    //         Auth::logout();
    //         return back()->withErrors(['email' => 'Unauthorized user']);
    //     }

    //     return back()->withErrors([
    //         'email' => 'Invalid credentials'
    //     ]);
    // }

    public function logout(User $user)
    {
        Auth::logout();
        return to_route('root')->withSuccess('Logout successfully');
    }
}
