<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <title>Login</title>
    <style>
        body {
            background-color: #E7E6DD; /* Light grayish background color */
        }
    
        .container {
            text-align: center;
        }
    
        .card {
            background: rgba(255, 255, 255, 1);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(3.4px);
            -webkit-backdrop-filter: blur(3.4px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    
        .card-body {
            padding: 2rem;
            background: rgba(255, 255, 255, 1);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(3.4px);
            -webkit-backdrop-filter: blur(3.4px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    
        input.form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            margin-bottom: 1rem;
        }
    
        button.btn {
            background-color: #8dc4fb;
            border-radius: 8px;
        }
    
        h2 {
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            /* color: #8dc4fb; */
        }
    </style>
    
</head>

<body>
    <div class="container mt-5">
        <div class="col-4 mx-auto">
            <div class="card shadow">
                <div class="card-body">
                    <h2>
                        <span style="color: #0056b3">SETOR</span>
                    </h2>
                    <form action="{{ route('post-login') }}" class="form-group" method="POST">
                        @csrf
                        <div class="mt-4">
                            <p>Masuk sebagai apa?...</p>
                            <input type="text" placeholder="Username..." name="username" class="form-control">
                        </div>
                        <div class="mt-3">
                            <input type="password" name="password" placeholder="Password..." class="form-control">
                        </div>
                        <div class="mt-3">
                            <button class="btn w-100 text-white" style="background-color: #E8C766">Login</button>
                        </div>
                        <hr class="mt-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
