<style>
    .card {
        background: rgba(255, 255, 255, 0.23);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(2.9px);
        -webkit-backdrop-filter: blur(2.9px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .card-head {
        padding: 20px;
    }

    .card-body {
        padding: 20px;
        background: rgba(255, 255, 255, 0.23); /* You can adjust this background if needed */
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(2.9px);
        -webkit-backdrop-filter: blur(2.9px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    /* Your existing styles remain unchanged below this point */

    .form-group {
        margin-bottom: 20px;
    }


    h2 {
        -webkit-text-stroke-color: black;
        -webkit-text-stroke: black;
    }
    /* ... rest of your styles ... */
</style>


@extends('template.html')
@section('title', 'Tambah Service')
@section('body')
    @include('template.nav')
    <div class="container col-md-6 mt-5">
        <div class="card shadow p-2" style="background-color:#E7E6DD; color: #fff; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
            <div class="card-head text-center">
                <h2>Tambah Service</h2>
            </div>
            <div class="card-body" style="padding: 20px;">
                <form action="{{ route('post-tambah') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control" accept="img/*" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="qty">Stock</label>
                        <input type="number" name="qty" id="qty" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" id="harga" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="">Pilih Status</option>
                            <option value="ada">Ada</option>
                            <option value="habis">Habis</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="harga_jasa">Harga Jasa</label>
                        <input type="number" name="harga_jasa" id="harga_jasa" class="form-control" required>
                    </div>
                    <div class="row justify-content-center">
                        <button class="btn btn-primary w-50" style="background-color: #E8C766;">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
