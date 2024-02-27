@extends('template.html')

@section('title', 'Homekasir')

@section('body')
    @include('template.nav')
    <div class="container mt-5">
        @if (Session::has('msg'))
            <div class="alert alert-primary">{{ Session::get('msg') }}</div>
        @endif
        <div class="card col-8 mx-auto p-4">
            <h5 class="text-center">Booking Service</h5>
            <table id="example" class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>No Kendaraan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $no_kendaraan => $group)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            {{-- <td>{{ $data->no_telp}}</td> --}}
                            <td>{{ $no_kendaraan }}</td>
                            <td>
                                <a href="{{ route('detailkasir',['no_kendaraan'=> $no_kendaraan])}}"
                                    class="btn btn-primary btn-sm">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('template.footer')
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
@endsection
