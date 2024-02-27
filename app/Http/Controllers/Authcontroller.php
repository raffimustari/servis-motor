<?php

namespace App\Http\Controllers;

use App\Models\log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authcontroller extends Controller
{
    function login()  {
        return view('welcome');
    }       

    function postLogin(Request $request)  {
        $cek = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($cek)) {
            $user = Auth::user();
            $logMessage = $user->nama . 'melakukan login';

            log::create([
                'aktivitas' =>  $logMessage,
                'user_id' => $user->id,
            ]);
            if ($user->role == 'montir') {
                return redirect()->route('home-montir')->with('msg', 'selamat datang di home', $user->nama);
            } elseif ($user->role == 'kasir') {
                return redirect()->route('home-kasir')->with('msg', 'selamat datang di home', $user->nama);
            } elseif ($user->role == 'admin') {
                return redirect()->route('dash-admin')->with('msg', 'selamat datang di dashboard', $user->nama);
            } else {
                return redirect()->route('home-owner')->with('msg', 'selamat datang di home', $user->nama);
            }
        } else {
            return redirect()->back()->with('msg', 'berhasil logout');
        }
        
    }

    function logout() {
        Auth::logout();
        
        return redirect()->route('login')->with('msg', 'berhasil keluar');
    }

}
