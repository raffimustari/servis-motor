<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pdf</title>
</head>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 20px;
    }

    #print-container {
        font-family: Arial, Helvetica, sans-serif;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin: 0 auto;
        max-width: 600px;
        /* background-image: url({{ asset('img/zaki.jpeg') }}) */
    }

    h2 {
        border:  solid #ddd;
        margin: 15px 0;
        text-align: center;
        font-size: 2em;
        text-transform: uppercase;  
    }
    p {
        margin: 5px 0;
    }
    div.total{
        margin-top: 15px;
        font-weight: bold;
        color: #333
    }
    div.change{
        color: #27ae60
    }
</style>
<body>
    <div id="print-container">
        <h2 >
        <span style="color: #3361AC">SETOR</span>
        </h2>  
        <hr>
        <div>
            <p>Tanggal : {{ $data[0]->created_at->format('d-m-Y') }}</p>
        </div>
        <div>
            <p>Nama : {{ $data[0]->nama }}</p>
        </div>
        <div>
            <p>no_hp : {{ $data[0]->no_telp }}</p>
        </div>
        <div>
            <p>no_kendaraan : {{ $data[0]->no_kendaraan  }}</p>
        </div>
        <div>
            <p>Invoice : {{ $data[0]->kode  }}</p>
        </div>
        <hr>
        <h5>Service yang di lakukan :</h5>
        @foreach ($data as $item)
        <table>
           <tr>
            <td>{{ $loop->iteration }} . {{ $item->service->nama }} |</td>
            <td> {{ $item->service->harga * $item->qty + $item->service->harga_jasa}}  |</td>
            <td> {{ $item->service->qty }}</td>
        </tr> 
        </table>

        {{-- <p>
            
           
           
        </p> --}}
            
        @endforeach
        <hr>        
        <div class="total">   
            <p for="" >Total Harga : {{ number_format($data[0]->total_harga, '2', ',', '.') }}</p>
        </div>
        <div>
            <p for="" >Uang Bayar : {{ number_format($data[0]->uang_bayar, '2', ',', '.') }}</p>
        </div>
        <div class="change">
            <p for="" >kembalian : {{ number_format($data[0]->uang_kembali, '2', ',', '.') }}</p>
        </div>
    </div>
</body>
</html>