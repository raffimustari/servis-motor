@extends('template.html')
@section('title', 'User')
@section('body')
    @include('template.nav')
    <div class="container mt-5">
        @if (Session::has('msg'))
            <div class="alert alert-primary">{{ Session::get('msg') }}</div>
        @endif
        <a href="{{ route('tambah-user') }}" class="btn text-white mb-3 text-light" style="background-color: #336B87">Tambah</a>
        <table class="table table-bordered table-striped" id="example">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>
                            {{$item->username}}
                        </td>
                        <td>{{ $item->password }}</td>
                        <td>{{ $item->role }}</td>
                        <td>
                            <div class="form-group d-flex">
                                <a href="{{route('edit', $item->id)}}" class="btn btn-outline-success m-2">Edit</a>
                                <form action="{{ route('hapus-user', $item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger m-2" onclick="return confirm('yakin dihapus?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
