@extends('template.html')

@section('title', 'Home Montir')

@section('body')
    @include('template.nav')
   
    <div class="container mt-5">
        @if (Session::has('msg'))
            <div class="alert alert-primary">{{ Session::get('msg') }}</div>
        @endif
        <div class="card col-10 mx-auto p-4">
            <h5 class="text-center mb-4">Booking Service</h5>
            {{-- <form action="{{ route('cari{service}') }}" method="GET" class="mb-4"> --}}
                {{-- <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by service name">
                    <button type="submit" class="btn btn-outline-primary">Search</button>
                </div> --}}
            </form>
            <div class="card-body">
                @forelse ($servis as $item)
                    <div class="card mb-4">
                        <form action="{{ route('detail', $item->id) }}" method="post" class="card-form">
                            @csrf
                            <div class="row g-0">
                                <div class="col-md-3">
                                    <img src="{{ asset($item->img) }}" alt="{{ $item->nama }}" class="img-fluid">
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->nama }}</h5>
                                        <p class="card-text">Harga: {{ $item->harga }}</p>
                                        <p class="card-text">Stock: {{ $item->qty }}</p>
                                        <div class="row align-items-center">
                                            <div class="col-4">
                                                <label for="qty" class="mb-0">Qty:</label>
                                                <input type="number" name="qty" required min="1" class="form-control">
                                            </div>
                                            <div class="col-8">
                                                <label for="merk">Merek:</label>
                                                <select name="merk" class="form-control" id="merk">
                                                    <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                    <!-- Tambahkan opsi merek lain jika diperlukan -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 d-flex align-items-center">
                                    <button class="btn btn-primary w-100">Pilih</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endforeach
                {{-- @empty
                    <p>No services found.</p>
                @endforelse --}}
            </div>
        </div>
    </div>
    @include('template.footer')
@endsection
