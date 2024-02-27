@extends('template.html')

@section('title', 'Summary')

@section('body')
    @include('template.nav')
    <div class="container mt-5">
        @if (Session::has('msg'))
            <div class="alert alert-primary">{{ session('msg') }}</div>
        @endif
        <div class="card col-8 mx-auto p-4">
            <h5 class="text-center">Summary</h5>
            <table class="table table-bordered" id="example">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No Kendaraan</th>
                        <th>Pemasukan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groupedTransactions as $noKendaraan => $group)
                        @php
                            $firstTransaction = $group->first();
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $firstTransaction->nama }}</td>
                            <td>{{ $firstTransaction->no_kendaraan }}</td>
                            <td>{{ $firstTransaction->total_harga }}</td>
                            <td>
                                <a href="{{ route('detail-summary', ['no_kendaraan' => $firstTransaction->no_kendaraan]) }}"
                                    class="btn btn-primary btn-sm">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
