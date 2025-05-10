<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) { // jika sudah login, maka redirect ke halaman home
            return redirect('/');
        }
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $credentials = $request->only('username', 'password');

            if (Auth::attempt($credentials)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Login Berhasil',
                    'redirect' => url('/')

                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Login Gagal'
            ]);
        }
        return redirect('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    public function showSignup()
    {
        $levels = LevelModel::all();
        return view('auth.signup', compact('levels'));
    }


    public function postSignup(Request $req)
    {
        if (!$req->ajax() && !$req->wantsJson()) {
            return redirect()->back();
        }

        $validator = Validator::make($req->all(), [
            'username' => 'required|string|min:5|max:20|unique:m_user,username',
            'nama' => 'required|string|min:5|max:100',
            'password' => 'required|string|min:6|confirmed',
        ]);



        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi Gagal',
                'msgField' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = UserModel::create([
            'username' => $req->username,
            'nama' => $req->nama,
            'level_id' => 3,
            'password' => Hash::make($req->password)
        ]);

        Auth::login($user);

        return response()->json([
            'message' => 'Data pengguna berhasil dibuat',
            'redirect' => url('/')
        ], Response::HTTP_OK);
    }
}