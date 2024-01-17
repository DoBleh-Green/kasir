<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>
<STyle>
    body {
        background-color: #2b2b2b;
        font-family: 'Roboto', sans-serif;
    }

    .content {
        margin-left: 369px;
        padding: 16px;
        color: #fff;
        /* Menyesuaikan warna teks sesuai kebutuhan Anda */
    }
</STyle>

<body>
    @include('component.sb')
    <div class="content">
        <h1 style="font-size: 40px">Selamat datang!</h1>
        <h1 style="font-size: 55px">{{ Auth::user()->name }}</h1>
        <h1 style="font-size: 40px">Anda berada di dashboard admin</h1>
    </div>
</body>

</html>
