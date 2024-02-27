<nav class="wave-header navbar-light bg-light">
    <div class="d-flex justify-content-between">
        <div>
            <a href="" class="nav navbar-brand nav-link" style="color: #3361AC"><B>SETOR</B></a>
        @if (auth()->user()->role == 'admin')
            <a href="{{ route('dash-admin') }}" class="nav nav-link text-dark">Kembali</a>
    
            <a href="{{ route('log-admin') }}" class="nav nav-link text-dark">Riwayat</a>
        @elseif (auth()->user()->role == 'montir')
            <a href="{{ route('home-montir') }}" class="nav-link text-dark">Kembali</a>
            <a href="{{ route('keranjang') }}" class="nav nav-link text-dark">keranjang</a>
        @elseif (auth()->user()->role == 'kasir')
            <a href="{{ route('home-kasir') }}" class="nav nav-link text-dark">Home</a>
            <a href="{{ route('summary') }}" class="nav nav-link text-dark">Riwayat</a>
        @else
            <a href="" class="nav-link text-dark">Kembali</a>
            <a href="" class="nav-link text-dark">Riwayat</a>
        @endif
        </div>
        <div>
            <form class="btn-outline d-flex" role="search" method="GET" action="{{ route('logout') }}">
                @csrf
                <button class="btn text-dark" type="submit">Keluar</button>
            </form>
        </div>
    </div>
</nav>
<style>
    .nav-link {
        display: inline-block;
        vertical-align: middle;
        line-height: normal;
    }
</style>
{{-- 
<nav class="wave-header navbar-light bg-light">
    <a href="" class="nav navbar-brand nav-link text-dark" style="font-style: bold ">Bengkel Rosi</a>
    @if (auth()->user()->role == 'admin')
        <a href="" class="nav nav-link text-dark"></a>
        <a href="" class="nav nav-link text-white">Summary</a>
        <a href="" class="nav nav-link text-dark">Log</a>
    @elseif (auth()->user()->role == 'montir')
        <a href="{{ route('home-montir') }}" class="nav-link text-dark"><img src="" alt=""></a>
        <a href="{{ route('keranjang') }}" class="nav nav-link text-dark"><img src="{{ asset('img/cart.png') }}" alt=""></a>
    @elseif (auth()->user()->role == 'kasir')
        <a href="{{ route('home-kasir') }}" class="nav nav-link text-dark"><img src="{{ asset('img/home.png') }}" alt=""></a>
        <a href="{{ route('summary') }}" class="nav nav-link text-dark"><img src="{{ asset('img/riwayat.png') }}" alt=""></a>
    @else
        <a href="" class="nav-link text-dark"><img src="{{ asset('img/home.png') }}" alt=""></a>
        <a href="" class="nav-link text-dark">Log</a>
    @endif
    <form class="btn-outline d-flex" role="search" method="GET" action="{{ route('logout') }}">
        @csrf
        <button class="btn text-dark" type="submit"><img src="{{ asset('img/logout.png') }}" alt=""></button>
    </form>

    
</nav> --}}
