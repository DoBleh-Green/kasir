<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/slct.css') }}">
</head>

<body>
    <div class="cont-drop">
        <div class="dropdown">
            <span>Stock Sort by</span>
            <span class="icon"><i class="fas fa-sort"></i></span>

            <div class="dropdown-content">
                <a href="{{ route('barang.index', ['sort' => 'desc']) }}">
                    <span class="icon">Stock <i style="color: green;" class="fas fa-angle-up"></i></span>
                </a>
                <a href="{{ route('barang.index', ['sort' => 'none']) }}">
                    <span class="icon">Stock <i style="color: #333;" class="fas fa-minus"></i></span>
                </a>
                <a href="{{ route('barang.index', ['sort' => 'asc']) }}">
                    <span class="icon">Stock <i style="color: red;" class="fas fa-angle-down"></i></span>
                </a>
            </div>
        </div>

    </div>

</body>

</html>
