<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    function dash() {
        $service = Service::all();

        return view('admin.dashboard', compact('service'));
    }

    function tambah() {
        $service = Service::all();

        return view('admin.tambah', compact('service'));
    }
    function ubah(Service $service) {

        return view('admin.ubah', compact('service'));
    }
    function postTambah(Request $request) {
        $request->validate([
            'nama' => 'required',
            'foto' => 'required|file|image',
            'qty' => 'required',
            'harga' => 'required',
            'status' => 'required',
            'harga_jasa' => 'required',
        ]);

        $user = Auth::user();
        Log::create([
            'user_id' => $user->id,
            'aktivitas' => $user->nama . " mengubah data Service " . $request->nama, 
        ]);

        $image = $request->file('foto')->store('img');

        Service::create(array_merge($request->all(), ['img' => $image]));

        return redirect()->route('dash-admin')->with('msg', "berhasil menambahkan Service");
    }
    function postUbah(Request $request, Service $service) {
        $request->validate([
            'nama' => 'required',
            'foto' => 'required|file|image',
            'qty' => 'required',
            'harga' => 'required',
            'status' => 'required',
            'harga_jasa' => 'required',
        ]);

        $user = Auth::user();
        
        Log::create([
            'user_id' => $user->id,
            'aktivitas' => $user->nama . " Menambahkan " . $request->nama, 
        ]);

        $image = $request->file('foto')->store('img');

        $service->update(array_merge($request->all(), ['foto' => $image]));

        return redirect()->route('dash-admin')->with('msg', "berhasil mengubah Service");
    }

    function hapus(Service $service) {
        $service->delete();

        return back()->with('msg', "berhasil menghapus service");
    }

    function user() {
        $user = User::all();

        return view('admin.user', compact('user'));
    }

    function tambahuser() {
        $user = User::all();

        return view('admin.tambahuser', compact('user'));
    }
    function ubahuser(User $user) {

        return view('admin.ubahuser', compact('user'));
    }
    function posttambahuser(Request $request) {
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $user = Auth::user();
        Log::create([
            'user_id' => $user->id,
            'aktivitas' => $user->nama . " menambah user " . $request->nama, 
        ]);

        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('dash-user')->with('msg', "berhasil menambahkan User");
    }
    function postubahuser(Request $request, User $user) {
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $users = Auth::user();
        Log::create([
            'user_id' => $users->id,
            'aktivitas' => $users->nama . " mengubah user " . $request->nama, 
        ]);

        $user->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('dash-user')->with('msg', "berhasil mengubah Service");
    }

    function hapususer(User $user) {
        $user->delete();

        return back()->with('msg', "berhasil menghapus user");
    }

    function log() {
        $logs = Log::whereHas('user', function ($query) {
            $query->where('role', '!=', 'admin')
                  ->where('role', '!=', 'owner');
        })->get();

        return view('admin.log', compact('logs'));
    }
    public function filterlog(Request $request)
    {
        // Mendapatkan tanggal awal dan akhir dari request
        $start_date = Carbon::parse($request->input('start_date'))->startOfDay();
        $end_date = Carbon::parse($request->input('end_date'))->endOfDay();

        // Menyaring transaksi berdasarkan rentang tanggal yang dipilih
        $logs = Log::whereHas('user', function ($query) {
            $query->where('role', '!=', 'admin')
                  ->where('role', '!=', 'owner');
        })->whereBetween('created_at', [$start_date, $end_date])->get();

        return view('admin.log', compact('logs'));
    }   
}
