@extends('template.html')

@section('title', 'report')
@section('body')
    @include('template.sidebar')
    <div class="" id="content">
        <div class="container mt-5">
            <div class="row mt-3">
                <div class="col-md-6 gap-2">
                    <form action="{{ route('report-filter') }}" method="GET" class="form-group">
                        @csrf
                        <div class="d-flex justify-content-between gap-2">
                            <label for="From">From</label>
                            <input type="date" name="start_date" class="form-control w-75" required>
                        </div>
                        <div class="d-flex justify-content-between gap-2 mt-3">
                            <label for="To">To</label>
                            <input type="date" name="end_date" class="form-control w-75" required>
                        </div>
                        <button class="btn mt-3 text-white form-control" style="background-color: #336B87">Filter</button>
                        {{-- @if (Session::has('msg'))
                        <span class="alert alert-danger">{{ Session::get('msg') }}</span>
                    @endif --}}
                    </form>
                </div>
                <div class="col-md-6 gap-2">
                    <form action="" method="GET" class="form-group">
                        @csrf
                        <div class="d-flex justify-content-between gap-2">
                            <label for="From">From</label>
                            <input type="date" name="start_date" class="form-control w-75" required>
                        </div>
                        <div class="d-flex justify-content-between gap-2 mt-3">
                            <label for="To">To</label>
                            <input type="date" name="end_date" class="form-control w-75" required>
                        </div>
                        <button class="btn mt-3 text-white form-control btn-danger">Print PDF</button>
                        {{-- @if (Session::has('msg'))
                        <span class="alert alert-danger">{{ Session::get('msg') }}</span>
                    @endif --}}
                    </form>
                </div>
            </div>
            <div class="row mt-3">
                <table id="example" class="table border mt-3 table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No Kendaraan</th>
                            <th>Pemasukan</th>
                            <th>Tanggal</th>
                            {{-- <th>Tanggal</th> --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groupBy as $noKendaraan => $group)
                            @php
                                $firstTransaction = $group->first(); // Get the first transaction in the group
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $firstTransaction->nama }}</td>
                                <td>{{ $firstTransaction->no_kendaraan }}</td>
                                <td>{{ $firstTransaction->total_harga }}</td>
                                <td>{{ $firstTransaction->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('detail-summary', ['no_kendaraan' => $firstTransaction->no_kendaraan]) }}"
                                        class="btn text-white form-control" style="background-color: #336B87">detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    
    </div>
@endsection
