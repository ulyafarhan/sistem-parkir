<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/'; // Arahkan ke Gerbang Masuk setelah login

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // ==================================
    // TAMBAHKAN FUNGSI INI
    // ==================================
    /**
     * Memberitahu Laravel untuk menggunakan 'nama_petugas' sebagai field login,
     * bukan 'email'.
     */
    public function username()
    {
        return 'nama_petugas';
    }
}