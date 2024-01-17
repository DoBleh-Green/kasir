<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <title>Document</title>
</head>
<style>

</style>

<body>
    @if ($errors->any())
        <div class="alert alert-danger text-center">
            <ul>
                @foreach ($errors->all() as $item)
                    <h4>{{ $item }}</h4><br>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container-center">
        <div class="container-form">
            <h1><b>Login</b></h1>
            <form action="" method="POST">
                {{-- yang dibawah ini digunakan untuk proses post ke bagian controler jadi memakai csrf --}}
                @csrf
                <div class="m-form">
                    <label for="Username">Email :</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="txt">
                    <label for="Password">Password</label>
                    <input type="password" name="password" value="" class="txt">
                    <button name="submit" type="submit" class="button">Login</button>
                </div>
            </form>

        </div>
    </div>
</body>

</html>
