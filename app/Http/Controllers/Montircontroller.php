<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class MontirController extends Controller
{

    public function cari(Request $request)
    {
        $search = $request->input('search');

        $service = Service::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->get();

        return view('montir.homemontir', compact('service'));
    }

    function home()
    {
        $servis = Service::all();
        return view('montir.homemontir', compact('servis'));
    }

    function detail(Request $request, Service $service)
    {
        if ($service->status === 'habis') {
            return back()->with('msg', 'Service tidak tersedia.');
        }

        // Validate the input quantity
        $request->validate([
            'qty' => 'required|numeric|min:1|max:' . $service->qty,
        ]);

        $quantity = $request->input('qty');

        // Create one transaction with the specified quantity
        Transaksi::create([
            'user_id' => Auth::id(),
            'service_id' => $service->id,
            'status' => 'keranjang',
            'qty' => $quantity,
        ]);

        return back()->with('msg', 'Berhasil diinput ke keranjang.');
    }

    function keranjang(Transaksi $transaksi)
    {
        $data = Transaksi::where('status', 'keranjang')->with('service')->get();
        $totalsemua = 0;

        // Loop melalui setiap transaksi
        foreach ($data as $transaksi) {
            // Hitung total harga untuk setiap transaksi
            $harga = $transaksi->service->harga * $transaksi->qty;
            $hargaTransaksi = $harga + $transaksi->service->harga_jasa;

            // Tambahkan total harga transaksi ke totalsemua
            $totalsemua += $hargaTransaksi;

            // Tambahkan variabel total_harga ke dalam objek transaksi jika diperlukan
            $transaksi->total_harga = $hargaTransaksi;
        }

        return view('montir.keranjang', compact('data', 'totalsemua'));
    }

    function postPesan(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'nama' => 'required',
            'no_telp' => 'required',
            'no_kendaraan' => 'required',
        ]);

        $transaksi = Transaksi::where('user_id', auth()->id())->where('status', 'keranjang')->with('service')->get();

        foreach ($transaksi as $item) {
            $item->update([
                'user_id' => Auth::id(),
                'nama' => $request->nama,
                'no_telp' => $request->no_telp,
                'no_kendaraan' => $request->no_kendaraan,
                'status' => 'dipesan',
            ]);

            //mengurangi qty dari service yang di pilih
            $item->service->decrement('qty', $item->qty);
        }

        return redirect()->route('home-montir')->with('msg', 'Berhasil memesan');
    }

    function hapus(Request $request)
    {
        $tranId = $request->id;
        $transaksi = Transaksi::where('id', $tranId)->first();
        $transaksi->delete();

        $user = Auth::user();
        $logMessage = $user->nama . ' menghapus service di transaksi';

        Log::create([
            'aktivitas' => $logMessage,
            'user_id' => $user->id
        ]);

        return back()->with('msg', 'data berhasil di hapus');
    }
}
