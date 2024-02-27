@extends('template.html')
@section('title', 'Ubah User')
@section('body')
    @include('template.nav')
    <div class="container col-md-6 mt-5">
        <div class="card shadow p-2" style="background-color: #336B87;">
            <div class="card-head text-center">
                <h2>Ubah User</h2>
            </div>
            <div class="card-body">
                <form action="{{route('edit-user', $user->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3"> 
                        <label for="">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control d-flex" value="{{$user->nama}}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Username</label>
                        <input type="text" name="username" id="nama" class="form-control d-flex" value="{{$user->username}}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Password</label>
                        <input type="password" name="password" id="nama" class="form-control d-flex" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Role</label>
                        <select name="role" class="form-control" id="">
                            <option value="{{$user->role}}">{{$user->role}}</option>
                            <option value="admin">Admin</option>
                            <option value="montir">Montir</option>
                            <option value="kasir">Kasir</option>
                            <option value="owner">Owner</option>
                        </select>
                    </div>
                    <div class="row justify-content-center">
                        <button class="btn btn-primary w-50" >Ubah</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
