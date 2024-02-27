@extends('template.html')

@section('title', 'Log')

@section('body')
    @include('template.nav')
    <div class="container mt-5">
        @if (Session::has('msg'))
            <div class="alert alert-primary">{{ Session::get('msg') }}</div>
        @endif
        <div class="card col-8 mx-auto p-4 shadow">
            <h5 class="text-center">Log</h5>
            <form action="{{ route('log-filter') }}" method="GET">
                @csrf
                <div class="row">
                    <input type="date" class="form-control w-25 m-2" name="start_date">
                    <input type="date" class="form-control w-25 m-2" name="end_date">
                    <button class="btn btn-success w-25 m-2 ms-5" type="submit">Filter</button>
                </div>
            </form>
            <table id="example" class="table table-secondary table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Aktivitas</th>
                        <th>Tanggal</th>
                        {{-- <th>Tanggal</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $log->user->nama }}</td>
                            <td>{{ $log->aktivitas }}</td>
                            <td>{{ $log->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@endsection
