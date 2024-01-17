<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/sb.css') }}">
    <title>Side Bar</title>
</head>

<body>
    <div class="sidebar">
        <div class="btn-top">
            <div class="btn-col">
                <a href="{{ route('admin') }}" class="btn-home"><i class="fas fa-house"></i> Home</a>
                <a href="{{ route('kasir.index') }}" class="btn-kasir"><i class="fas fa-address-book"></i>
                    Crud Kasir</a>
                <a href="{{ route('barang.index') }}" class="btn-barang"><i class="fas fa-box"></i> Crud Barang</a>
                <a href="{{ route('history.index') }}" class="btn-trans"><i class="fas fa-clock-rotate-left"></i> View
                    Transaksi</a>
            </div>
        </div>
        <a href="/logout" class="btn-logout"><i class="fas fa-door-open"></i> Logout</a>
    </div>

    <script src="https://kit.fontawesome.com/d7c9159410.js" crossorigin="anonymous"></script>
</body>

</html>


{{-- 
<style>
    body {
        font-family: "roboto", sans-serif;
        margin: 0;
    }

    .sidebar {
        height: 100%;
        width: 320px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #d9d9d9;
        padding-top: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .btn-top a {
        text-decoration: none;
        font-size: 25px;
        text-align: center;
        background-color: #bebebe;
        color: black;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 14px;
        margin-bottom: 34px;
    }

    .btn {
        display: flex;
        flex-direction: column;
    }

    .btn-home {
        border-radius: 7px;
        width: 140px;
        height: 64px;
    }

    .btn-kasir {
        border-radius: 7px;
        width: 213px;
        height: 64px;
    }

    .btn-barang {
        border-radius: 7px;
        width: 223px;
        height: 64px;
    }

    .btn-trans {
        border-radius: 7px;
        width: 257px;
        height: 64px;
    }

    .btn-home i,
    .btn-kasir i,
    .btn-barang i,
    .btn-trans i,
    .btn-logout i {
        margin-right: 8px;
        /* Atur jarak antara ikon dan teks */
    }

    .btn-home {
        background-color: #1E90FF;
    }

    .btn-kasir {
        background-color: #32CD32;
    }

    .btn-barang {
        background-color: #FFD700; ///
    }

    .btn-trans {
        background-color: #9370DB;
    }

    .btn-logout {
        background-color: #FF6B65;
    }
</style>
</head>

<div class="sidebar">
    <div class="btn-top">
        <div class="btn">
            <a href="#" class="btn-home"><i class="fa-solid fa-house"></i> Home</a>
            <a href="#" class="btn-kasir"><i class="fa-solid fa-address-book"></i> Crud Kasir</a>
            <a href="#" class="btn-barang"><i class="fa-solid fa-box"></i> Crud Barang</a>
            <a href="#" class="btn-trans"><i class="fa-solid fa-clock-rotate-left"></i> View Transaksi</a>
        </div>
    </div>
    <a href="#" class="btn-logout"><i class="fa-solid fa-door-open"></i> Logout</a>
</div>



<script src="https://kit.fontawesome.com/d7c9159410.js" crossorigin="anonymous"></script> --}}
