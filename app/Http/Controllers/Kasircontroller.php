<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;


class Kasircontroller extends Controller
{
    function home()
    {

        $transaksi = transaksi::where('status', 'dipesan')->get();
        $data = $transaksi->groupBy('no_kendaraan');
        return view('kasir.homekasir', compact('data'));
    }

    function detailkasir($no_kendaraan)
    {
        $data = transaksi::where('no_kendaraan', $no_kendaraan)->where('status', 'dipesan')->with('service')->get();
        // dd($data); 
        $totalharga = $data->sum(function ($transaksi) {
            return $transaksi->service->harga * $transaksi->qty + $transaksi->service->harga_jasa;
        });
        return view('kasir.detailkasir', compact('data', 'totalharga'));
    }

    function bayar()
    {
    }

    function lunas(Request $request)
    {
        $request->validate([
            'uang_bayar' => 'required',
            'total_harga' => 'required',
            'uang_kembali' => 'required',
        ]);

        $no_motor = $request->no_kendaraan;
        $transaksi = transaksi::where('no_kendaraan', $no_motor)->where('status', 'dipesan')->with('service')->get();

        foreach ($transaksi as $item) {
            $item->update([
                'kode' => 'INV' . Str::random(10),
                'total_harga' => $request->total_harga,
                'uang_bayar' => $request->uang_bayar,
                'uang_kembali' => $request->uang_kembali,
                'status' => 'lunas',
            ]);
        }
        return Redirect()->route('detail-summary', ['no_kendaraan' => $no_motor])->with('msg', 'berhasil melakukan transaksi');
    }
    function detailSummary($no_kendaraan)
    {
        $data = transaksi::where('no_kendaraan', $no_kendaraan)->where('status', 'lunas')->get();

        return view('kasir.detailsummary', compact('data'));
    }

    function summary()
    {
        $transaksis = Transaksi::where('status', 'lunas')->with('service')->get();
        $pemasukan = $transaksis->sum(function ($transaksi) {
            return $transaksi->service->harga * $transaksi->qty + $transaksi->service->harga_jasa;
        });


        $filteredTransactions = $transaksis->unique(function ($item) {
            return $item->no_kendaraan . $item->created_at;
        });


        $groupedTransactions = $filteredTransactions->groupBy('no_kendaraan');

        return view('kasir.summary', compact('groupedTransactions', 'pemasukan'));
    }

    public function filter(Request $request)
    {

        $start_date = Carbon::parse($request->input('start_date'))->startOfDay();
        $end_date = Carbon::parse($request->input('end_date'))->endOfDay();


        $transaksis = Transaksi::whereBetween('created_at', [$start_date, $end_date])
            ->where('status', 'lunas')
            ->with('service')
            ->get();


        $pemasukan = $transaksis->sum(function ($transaksi) {
            return $transaksi->service->harga * $transaksi->qty + $transaksi->service->harga_jasa;
        });


        $filteredTransactions = $transaksis->unique(function ($item) {
            return $item->no_kendaraan . $item->created_at;
        });

        $groupedTransactions = $filteredTransactions->groupBy('no_kendaraan');
        return view('kasir.summary', compact('groupedTransactions', 'pemasukan'));
    }

    function pdf($no_kendaraan)  {
        $transaksi = transaksi::where('no_kendaraan', $no_kendaraan)->where('status', 'lunas')->get();
        $invoice = $transaksi->first()->kode;

        $data =[
            'data' => $transaksi

        ];

        $pdf = Pdf::loadView('kasir.pdf', $data);
        return $pdf->download($invoice . '.pdf');
    }
}
