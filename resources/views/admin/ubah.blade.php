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
  
            <div class="card-head text-white text-center">
                <h2>Ubah</h2>
            </div>
            <div class="card-body" style="padding: 20px;">
                <form action="{{route('ubah', $service->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="">Foto</label>
                        <input type="file" name="foto" id="nama" class="form-control d-flex" accept="img/*" value="{{$service->foto}}" required>
                    </div>
                    <div class="form-group mb-3"> 
                        <label for="">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control d-flex" value="{{$service->nama}}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Stock</label>
                        <input type="number" name="qty" id="nama" class="form-control d-flex" value="{{$service->qty}}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Harga</label>
                        <input type="number" name="harga" id="nama" class="form-control d-flex" value="{{$service->harga}}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Status</label>
                        <select name="status" class="form-control" id="">
                            <option value="{{$service->status}}">{{$service->status}}</option>
                            <option value="ada">Ada</option>
                            <option value="habis">Habis</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Harga Jasa</label>
                        <input type="number" name="harga_jasa" id="nama" class="form-control d-flex" value="{{$service->harga_jasa}}" required>
                    </div>
                    <div class="row justify-content-center">
                        <button class="btn btn-primary w-50" style="background-color: #E8C766;">Ubah</button>
                
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection





