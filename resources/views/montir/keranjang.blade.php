<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        padding: 12px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }

    table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    table-hover tbody tr:hover {
        background-color: #f5f5f5;
    }
</style>


@extends('template.html')

@section('title', 'Keranjang')
@section('body')
    @include('template.nav')

    <div class="container mt-5">
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title text-center mb-0">Booking Servis</h5>
            </div>
            <div class="card-body">
                @if (Session::has('msg'))
                    <div class="alert alert-primary">{{ session('msg') }}</div>
                @endif

                <form action="{{ route('post-pesan') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control mb-3" required>
                        </div>
                        <div class="col-md-6">
                            <label for="no_telp">No HP</label>
                            <input type="text" name="no_telp" class="form-control mb-3" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="no_kendaraan">No Kendaraan</label>
                            <input type="text" name="no_kendaraan" class="form-control mb-3" required>
                        </div>
                    </div>

                    <h5 class="mt-4 mb-3">Layanan Service yang Dipilih :</h5>

                    <div class="table-responsiv">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Servis</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Harga Jasa</th>
                                    <th>Total Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                    <tr>
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset($item->service->img) }}" alt="" width="100"
                                                height="100">
                                        </td>
                                        <td>{{ $item->service->nama }}</td>
                                        <td>{{ number_format($item->service->harga, 0, ',', '.') }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->service->harga_jasa }}</td>
                                        <td>{{ number_format($totalsemua, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('hapus', ['id' => $item->id]) }}"
                                                class="btn btn-danger">Hapus</a>
                                        </td>
                                    </tr>
                                    </tr>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </table>
                    <div class="row mt-3">
                        <div class="col-md-4 ml-auto">
                            <button type="submit" class="btn btn-primary form-control">Pesan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        new DataTable('#example');
    </script>

@endsection
