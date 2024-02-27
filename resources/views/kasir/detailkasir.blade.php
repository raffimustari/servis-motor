@extends('template.html')

@section('tittle', 'login')

@section('body')
    @include('template.nav')
    <div class="container mt-5">
        <div class="card col-8 mx-auto shadow p-4 opacity-75">
            <div class="row">
                <div class="col-4 mx-auto pb-4">
                    <h5 class="card-title">Nama : {{ $data[0]->nama }}</h5>
                </div>
                <div class="col-4 mx-auto pb-2">
                    <h5 class="card-title">No Kendaraan :{{ $data[0]->no_kendaraan }}</h5>
                </div>
                <div class="col-4 mx-auto pb-2">
                    <h5 class="card-title">No hp :{{ $data[0]->no_telp }}</h5>
                </div>
                <hr>
                <h5 class="card-title">Service yang di pilih</h5>
                @foreach ($data as $item)
                    <p class="card-text">{{ $loop->iteration }}. {{ $item->service->nama }} : </p>
                @endforeach 
                <hr>
                <form action="{{ route('lunas', ['no_kendaraan' => $data[0]->no_kendaraan]) }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-4 mx-auto">
                            <label for="" class="pt-4">total harga :</label>
                            <input type="text" name="total_harga" id="total_harga" class="form-control bg-gray d-flex"
                                required readonly value="{{ $totalharga }}" >
                        </div>
                        <div class="col-4 mx-auto">
                            <label for="" class="pt-4">Uang bayar :</label>
                            <input type="number" name="uang_bayar" id="uang_bayar" placeholder="Masukan uang tunai..."
                                oninput="pengurangan()" class="form-control bg-gray d-flex" required>
                        </div>
                        <div class="col-4 mx-auto">
                            <label for="" class="pt-4">uang kembali :</label>
                            <input type="text" name="uang_kembali" id="uang_kembali" class="form-control bg-gray d-flex"
                                required readonly>
                        </div>

                    </div>
            </div>
            <center>
                <button class="btn btn-success w-50">bayar</button>
            </center>
            </form>
        </div>
    </div>
    </div>
    <script>
        function pengurangan() {
            var total_harga = parseFloat(document.getElementById('total_harga').value);
            var uang_bayar = parseFloat(document.getElementById('uang_bayar').value);
            var btnlunas = document.getElementById('btn_lunas');

            var uang_kembali = uang_bayar - total_harga;

            if (uang_bayar < total_harga) {
                var uang_tidak = uang_kembali.textContent = 'uang tidak cukup';
                document.getElementById('uang_kembali').value = uang_tidak;
                btnlunas.disabled = true;
            } else {
                document.getElementById('uang_kembali').value = uang_kembali;
                btnlunas.disabled = false;
            }
        }
    </script>
@endsection
