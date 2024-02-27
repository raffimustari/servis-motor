<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Transaksi;
use Carbon\Carbon;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    function home() {
        $transaksis = Transaksi::where('status', 'lunas')->with('service')->get();

        $tanggal = [];
        $pemasukan = [];
    
        foreach ($transaksis as $transaksi) {
            $tanggal[] = Carbon::parse($transaksi->updated_at)->format('d-m-Y');
    
            // Hitung pemasukan per transaksi
            $pemasukan[] = ($transaksi->service->harga * $transaksi->qty + $transaksi->service->harga_jasa);
        }

        $totalpemasukan = array_sum($pemasukan);

        $chart = (new LarapexChart)->setType('area')
        ->setXAxis($tanggal)
        ->setDataset([
            [
                'name' => 'pemasukan',
                'data' => $pemasukan
            ]
        ])->setColors(
            ['#E8C766']
        );

        // $pieChart = (new LarapexChart)->setType('pie')
        //     ->setTitle('Pemasukan')
        //     ->setSubtitle('dari transaksi Hari Ini')
        //     ->setXAxis($tanggal)
        //     ->setDataset([
        //         [
        //             'name' => 'pemasukan',
        //             'data' => $pemasukan
        //         ]
        //     ]);

        return view('owner.home', compact('chart',  'totalpemasukan'));
    }

    function filterowner(Request $request) {
        $start_date = Carbon::parse($request->input('start_date'))->startOfDay();
        $end_date = Carbon::parse($request->input('end_date'))->endOfDay();

        $transaksis = Transaksi::whereBetween('updated_at', [$start_date, $end_date])
                           ->where('status', 'lunas')
                           ->with('service')
                           ->get();

        $tanggal = [];
        $pemasukan = [];
    
        $transaksis = $transaksis->sortBy('updated_at');

        foreach ($transaksis as $transaksi) {
            $tanggal[] = Carbon::parse($transaksi->updated_at)->format('d-m-Y');
    
            // Hitung pemasukan per transaksi
            $pemasukan[] = ($transaksi->service->harga * $transaksi->qty + $transaksi->service->harga_jasa);
        }

        $totalpemasukan = array_sum($pemasukan);

        $chart = (new LarapexChart)->setType('area')
        ->setTitle('Pemasukan')
        ->setSubtitle('dari transaksi Hari Ini')
        ->setXAxis($tanggal)
        ->setDataset([
            [
                'name' => 'pemasukan',
                'data' => $pemasukan
            ]
        ])->setColors(
            ['#E8C766']
        )
        
        ;

    // Mengirimkan data ke view 'transaksi' bersama dengan total pemasukan
        return view('owner.home', compact('chart', 'totalpemasukan'));
    }


    function logowner() {
        $logs = Log::all();

        return view('owner.log', compact('logs'));
    }
    public function filterlog(Request $request)
    {
        // Mendapatkan tanggal awal dan akhir dari request
        $start_date = Carbon::parse($request->input('start_date'))->startOfDay();
        $end_date = Carbon::parse($request->input('end_date'))->endOfDay();

        // Menyaring transaksi berdasarkan rentang tanggal yang dipilih
        $logs = Log::all();

        return view('owner.log', compact('logs'));
    }
    public function summary()
    {
        $transaksi = Transaksi::where('status', 'lunas')->with('service')->get();
        $pemasukan = $transaksi->sum(function ($transaksi) {
            return $transaksi->service->harga * $transaksi->qty + $transaksi->service->harga_jasa;
        });
    
        // Filter transactions with the same 'no_kendaraan' and 'created_at'
        $filteredTransactions = $transaksi->unique(function ($item) {
            return $item->no_kendaraan . $item->created_at;
        });
    
        // Group transactions by 'no_kendaraan'
        $groupBy = $filteredTransactions->groupBy('no_kendaraan');
    
        return view('owner.report', compact('groupBy', 'pemasukan'));
    }
    public function filter(Request $request)
    {
        // Mendapatkan tanggal awal dan akhir dari request
        $start_date = Carbon::parse($request->input('start_date'))->startOfDay();
        $end_date = Carbon::parse($request->input('end_date'))->endOfDay();

        // Menyaring transaksi berdasarkan rentang tanggal yang dipilih
        $transaksis = Transaksi::whereBetween('updated_at', [$start_date, $end_date])
                           ->where('status', 'lunas')
                           ->with('service')
                           ->get();

        // Menghitung total pemasukan dari transaksi yang telah disaring
        $pemasukan = $transaksis->sum(function ($transaksi) {
             return $transaksi->service->harga * $transaksi->qty + $transaksi->service->harga_jasa;
        });

    // Menyaring transaksi dengan 'no_kendaraan' dan 'created_at' yang sama
        $filteredTransactions = $transaksis->unique(function ($item) {
            return $item->no_kendaraan . $item->created_at;
        });

    // Mengelompokkan transaksi berdasarkan 'no_kendaraan'
        $groupBy = $filteredTransactions->groupBy('no_kendaraan');

    // Mengirimkan data ke view 'transaksi' bersama dengan total pemasukan
        return view('owner.report', compact('groupBy', 'pemasukan'));
    } 
    function pdfsum(){
        $transaksi = Transaksi::where('status', 'lunas')->with('service')->get();
        $pemasukan = $transaksi->sum(function ($transaksi) {
            return $transaksi->service->harga * $transaksi->qty + $transaksi->service->harga_jasa;
        });
    
        // Filter transactions with the same 'no_kendaraan' and 'created_at'
        $filteredTransactions = $transaksi->unique(function ($item) {
            return $item->no_kendaraan . $item->created_at;
        });
    
        // Group transactions by 'no_kendaraan'
        $groupedTransactions = $filteredTransactions->groupBy('no_kendaraan');
    
        return view('kasir.summary', compact('groupedTransactions', 'pemasukan'));
    }
}
