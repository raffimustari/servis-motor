<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('tittle')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<style>

    ::-webkit-scrollbar{
        width: 15px;
    }
    ::-webkit-scrollbar-track{
        background: #fff;
    }
    ::-webkit-scrollbar-thumb{
        background: #708090;
    }
     body {

        background-color: #E7E6DD;
        /* background-image: url('{{ url('img/stm.jpeg') }}');
        background-size: 100%;
        background-repeat: no-repeat;
        background-position: center; */
     }

     .container {
    margin-top: 50px;
}

.card {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
}

     /* .wave-header {
   background: linear-gradient(90deg, #fdecb7 50%, #8dc4fb 50%);
        background-position: 200% 0; 
    background-size: 200% 100%;
    animation: wave-animation 2s infinite;
    border-bottom-left-radius: 50% 20px;
    border-bottom-right-radius: 50% 20px;
} */

.frosted-glass-overlay      {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(255, 255, 255, 0.7); /* Semi-transparent white */
  mix-blend-mode: multiply; /* Applies frosted effect */
  z-index: -1; /* Ensure overlay is behind table */
}

 
/* @keyframes wave-animation {
    0% {
    }
    100% {
        background-position: -200% 0;
    }
} */

    
</style>
<body>
    @yield('body')
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
