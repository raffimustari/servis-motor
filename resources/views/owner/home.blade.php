<style>
    .container {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: 1px solid #007bff;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border: 1px solid #0056b3;
    }

    .alert {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f8d7da;
        color: #721c24;
    }

    body {
        font-family: 'Arial', sans-serif;
        font-size: 16px;
        line-height: 1.6;
        color: #333;
    }

    h4 {
        font-size: 1.5em;
        margin-bottom: 10px;
    }

    h5.card-title {
        font-size: 1.2em;
        margin-bottom: 10px;
    }

    /* Style for better table appearance */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    /* Add responsive styling */
    @media (max-width: 767px) {
        table {
            overflow-x: auto;
            display: block;
        }
    }

    .alert {
        margin-bottom: 20px;
    }
</style>


@extends('template.html')

@section('title', 'Home Owner')

@section('body')
    @include('template.nav')
    <div id="content">
        <div class="container mt-5">
            <div class="mt-3">
                <h4>{{ number_format($totalpemasukan, 2, ',', '.') }}</h4>
            </div>
            <div class="row mt-4">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Pemasukan</h5>
                        </div>
                        <div class="card-body">
                            {!! $chart->container() !!}
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <form action="{{ route('filterowner') }}" method="GET" class="form-group">
                        @csrf
                        <div class="mb-3">
                            <label for="from" class="form-label">From</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="to" class="form-label">To</label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>
                        <button class="btn form-control text-white" style="background-color: #E8C766">Filter</button>
                        {{-- @if (Session::has('msg'))
                                <span class="alert alert-danger">{{ Session::get('msg') }}</span>
                            @endif --}}
                    </form>
                </div>
                <div class="col-8">
                    {{-- {!! $pieChart->container() !!} --}}
                </div>
            </div>
        </div>
        @include('template.footer')
    </div>

    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
    {{-- {{ $pieChart->script() }} --}}
    </body>

@endsection
