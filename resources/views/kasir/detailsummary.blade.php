@extends('template.html')

@section('title', 'Detail Summary')

@section('body')
   @include('template.nav')
    <div id="content">
        <div class="container mt-5">
            <div id="print-container" class="card col-8 mx-auto shadow p-4">
                <h2>
                <span style="color: #3361AC; font-weight: 600; font-family: 'poppins', sans-serif;">Detail</span>Summary    
                </h2>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><strong>Tanggal</strong></td>
                            <td>{{ $data[0]->created_at->format('Y-m-d') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Nama</strong></td>
                            <td>{{ $data[0]->nama }}</td>
                        </tr>
                        <tr>
                            <td><strong>No Hp</strong></td>
                            <td>{{ $data[0]->no_telp }}</td>
                        </tr>
                        <tr>
                            <td><strong>No Kendaraan</strong></td>
                            <td>{{ $data[0]->no_kendaraan }}</td>
                        </tr>
                        <tr>
                            <td><strong>Invoice</strong></td>
                            <td>{{ $data[0]->kode }}</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <h5 class="card-title">Service yang dilakukan :</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Service</th>
                            <th scope="col">jumlah</th>
                            <th scope="col">Harga satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->service->nama }}</td>
                                <td>{{ $item->service->qty }}</td>
                                <td>{{ $item->service->harga * $item->qty + $item->service->harga_jasa }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
                <div class="pb-3">
                    <label for=""><strong>Total Harga:</strong></label>
                    <label for="">{{ number_format($data[0]->total_harga, '2', ',', '.') }}</label>
                </div>
                <div class="pb-3">
                    <label for=""><strong>Uang Bayar:</strong></label>
                    <label for="">{{ number_format($data[0]->uang_bayar, '2', ',', '.') }}</label>
                </div>
                <div class="pb-3">
                    <label for=""><strong>Kembalian:</strong></label>
                    <label for="">{{ number_format($data[0]->uang_kembali, '2', ',', '.') }}</label>
                </div>

                <a href="{{ route('pdf', ['no_kendaraan' => $data[0]->no_kendaraan]) }}"
                    class="btn form-control text-white" style="background-color: #336B87">Print</a>
            </div>
        </div>
    </div>
    @include('template.footer')
@endsection
